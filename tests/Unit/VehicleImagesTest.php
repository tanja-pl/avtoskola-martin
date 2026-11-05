<?php

namespace Tests\Unit;

use Tests\TestCase;

use function App\Support\Chat\vehicleImagesForMessage;

class VehicleImagesTest extends TestCase
{
    public function test_price_question_does_not_attach_photos(): void
    {
        $images = vehicleImagesForMessage('Колку чини Б категорија?');

        $this->assertSame([], $images);
    }

    public function test_photo_request_returns_only_that_category(): void
    {
        $images = vehicleImagesForMessage('Покажи ми слика за Б категорија');
        $files = $this->filenames($images);

        $this->assertContains('b-1.png', $files);
        $this->assertNotContains('b-automatic.png', $files);
        $this->assertNotContains('a1.png', $files);
        $this->assertNotContains('c.jpg', $files);
    }

    public function test_motorcycle_photo_is_not_shared_across_categories(): void
    {
        $images = vehicleImagesForMessage('Сакам слика за A1');
        $files = $this->filenames($images);

        $this->assertSame(['a1.png'], $files);
    }

    public function test_category_without_a_photo_returns_nothing(): void
    {
        $this->assertSame([], vehicleImagesForMessage('Покажи слика за AM категорија'));
    }

    public function test_follow_up_photo_uses_the_category_already_discussed(): void
    {
        $images = vehicleImagesForMessage('Покажи слика', [
            ['role' => 'user', 'content' => 'Ме интересира Ц категорија'],
        ]);
        $files = $this->filenames($images);

        $this->assertContains('c.jpg', $files);
        $this->assertNotContains('ce.jpg', $files);
        $this->assertNotContains('b-1.png', $files);
    }

    /**
     * @param  list<array{url: string, alt: string}>  $images
     * @return list<string>
     */
    private function filenames(array $images): array
    {
        return array_map(static function (array $image): string {
            return rawurldecode(basename(parse_url($image['url'], PHP_URL_PATH) ?: ''));
        }, $images);
    }
}
