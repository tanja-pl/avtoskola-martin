@if ($conversation->contact_provided)
  <span class="badge badge-contact">Контакт</span>
@endif
@if ($conversation->enrollment_interest)
  <span class="badge badge-enroll">Запишување</span>
@elseif ($conversation->interestLabel())
  <span class="badge badge-interest">{{ $conversation->interestLabel() }}</span>
@endif
