# 🎓 Career 180 LMS Quest

[![Laravel 12](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Livewire 3](https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-06B6D4?style=for-the-badge&logo=tailwindcss)](https://tailwindcss.com)
[![Pest PHP](https://img.shields.io/badge/Pest-2.x-0195ff?style=for-the-badge&logo=pest)](https://pestphp.ai)

A high-performance Mini-LMS built for the **Career 180 Quest**. This project demonstrates a production-ready architecture focusing on data integrity, idempotent business logic, and a seamless "Theater Mode" user experience.

---

## 🚀 Live Demo & Credentials

**Live URL:** https://career180.shattor.com  
**Admin Panel:** `/admin`

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `youwillhireme@career180.com` | `iwillhireyou` |
| **Student** | `youwillhiremealso@career180.com` | `iwillhireyou` |

---

## 🛠️ Technical Highlights

This submission goes beyond basic CRUD functionality by implementing several senior-level architectural patterns:

*   **⚡ Idempotent Action Pattern:** Core business flows (Enrollment, Registration, Progress Tracking) are encapsulated in single-responsibility, invokable Action classes. These utilize database transactions and `firstOrCreate` logic to ensure system stability even under rapid-fire or concurrent requests.
*   **🎥 Alpine.js & Plyr Hybrid:** Video progress is managed via a sophisticated Alpine.js bridge to Plyr.io. Progress is tracked client-side and synced to the Laravel backend using throttled updates (every 10 seconds) to minimize server load while maintaining accuracy.
*   **🔗 Unique Slug Soft-Delete Handling:** Solved the "Unique Constraint vs. Soft Delete" conflict by implementing a model observer that appends a timestamp to slugs upon deletion, allowing original slugs to be reused immediately while preserving data history.
*   **🌍 Global Timezone Strategy:** All timestamps are stored in **UTC**. The frontend utilizes a custom Alpine.js `local-time` component to detect the user's browser timezone and format timestamps locally via the `Intl.DateTimeFormat` API.

---

## 💻 Local Setup

Follow these steps to get the project running locally:

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/bwazik/lms-quest.git
    cd lms-quest
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    npm install
    ```

3.  **Environment configuration:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database & Seeding:**
    Configure your `.env` database settings, then run:
    ```bash
    php artisan migrate --seed
    ```
    *Note: The seeder creates 1 Admin, 1 User, 3 Difficulty Levels, and 3 Courses with a mix of free previews and locked content.*

5.  **Compile assets & Start server:**
    ```bash
    npm run dev
    php artisan serve
    ```

---

## ✅ Testing (Pest PHP)

The test suite is exhaustive, covering core logic, authorization policies, and database constraints.

```bash
php artisan test
```

![Pest Tests Passing](tests-screenshot.png)

**Test Coverage Highlights:**
*   **Idempotency:** Verifies that rapid enrollment or completion attempts do not create duplicate records.
*   **Data Isolation:** Ensures students cannot access or modify progress data belonging to other accounts.
*   **Concurrency:** Validates transactional consistency between lesson completion and course-wide graduation.

---

## 📝 Assumptions & Limitations

*   **Linearity:** Students can navigate lessons freely within a course. While progress is tracked, strict "Lesson Locking" (requiring Lesson 1 to finish before Lesson 2) was omitted to enhance the user's learning flexibility.
*   **Payments:** The enrollment flow is "Open Access." While the UI supports an enrollment trigger, payment gateways are mocked/omitted as the focus was on the core LMS logic and progress engine.
*   **Storage:** Course images and videos are served locally for the prototype. In a production environment, these would be offloaded to an S3-compatible bucket.

---

## 🔮 If I had more time...

Given more time, I would implement the following architectural enhancements:

1.  **Denormalized Progress Caching:** Transition the real-time progress calculation to a denormalized column on the `enrollments` table. I would use **Queued Jobs** to update this value asynchronously, ensuring the Admin panel remains lightning-fast even with tens of thousands of users.
2.  **Netflix-style Resume Logic:** Store the exact `watch_seconds` in the database on a `beforeunload` event. This would allow students to refresh their page and have the Plyr player automatically seek to the exact second where they left off.
3.  **Drop-off Analytics:** Build a "Lesson Heatmap" for instructors. By tracking where users stop watching, we could provide admins with visual analytics identifying "difficult" or "boring" lessons that need content updates.
