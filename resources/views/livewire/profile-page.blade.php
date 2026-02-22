<div class="bg-slate-50 dark:bg-slate-950 min-h-screen">
    <!-- Header -->
    <div class="relative overflow-hidden">
        <div
            class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 via-violet-500/5 to-slate-50 dark:from-indigo-600/10 dark:via-violet-500/5 dark:to-slate-950">
        </div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-violet-400/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            <p class="text-sm font-bold uppercase tracking-widest text-indigo-500 dark:text-indigo-400 mb-2">
                Account</p>
            <h1 class="text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white">
                Profile Settings
            </h1>
            <p class="mt-2 text-slate-500 dark:text-slate-400">
                Manage your account information and security preferences.
            </p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-6">
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</div>
