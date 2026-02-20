# Project Overview
Mini-LMS for "Career 180" quest. Focus is on data integrity, concurrency handling, and clean architecture.

## Tech Stack
- Laravel 12 / PHP 8.5+
- Livewire v3 & Alpine.js (Frontend)
- Filament v3 (Admin Panel)
- Pest (Testing)
- Tailwind CSS
- MySQL

## Architectural & Coding Rules (STRICT)
1. **Action Classes ONLY for Business Logic:** Controllers and Livewire components MUST NOT contain complex logic. All core flows (Registration, Enrollment, Progress Tracking, Course Completion) must be extracted into single-responsibility, invokable Action classes (e.g., `App\Actions\EnrollUserAction`).
2. **Concurrency & Data Integrity:** Database transactions (`DB::transaction`) and pessimistic locking (`lockForUpdate()`) MUST be used in Actions modifying state (e.g., marking a lesson complete). Operations must be Idempotent (no duplicate enrollments, no duplicate completion emails).
3. **No N+1 Queries:** Always use Eager Loading (`with()`, `load()`) in Filament and Livewire to prevent N+1 issues, especially when calculating user progress.
4. **Fat Models, Thin Controllers:** Keep Eloquent scopes, accessors, and relationships cleanly defined in the Models.
5. **Soft Deletes:** Use SoftDeletes for Courses and Lessons. Ensure `slug` uniqueness handles trashed records correctly (e.g., unique rule ignoring trashed, or appending timestamp on delete).

## Timezone Handling
- All timestamps stored in UTC.
- Display timestamps in user’s timezone.

## Frontend & UI Rules
- Use Livewire v3 for component state.
- **Alpine.js is MANDATORY** for interactive UI behaviors (accordions, modals, progress bar animations, Plyr.js hooks). Do not use Livewire for purely client-side state.
- Videos are played using Plyr.js.

## Testing (Pest)
- All feature tests must use Pest.
- Test concurrency, database constraints (unique composites), and transactional rollbacks.
- Emails must be asserted using `Mail::fake()`.

## Admin (Filament v3)
- Use standard Filament Resources for Levels, Courses, Lessons, Users.
- Use Relation Managers (e.g., Course has Lessons) and allow reordering lessons via the `order` column.
