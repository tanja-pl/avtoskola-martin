Нова порака од контакт-формата

Име: {{ $payload['name'] }}
Телефон: {{ $payload['phone'] }}
Е-пошта: {{ $payload['email'] ?: '(не е внесено)' }}
Предмет: {{ $payload['subject'] ?: 'Општа порака' }}

Порака:
{{ $payload['message'] }}
