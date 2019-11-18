<?php

// Dashboard
Breadcrumbs::for ('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > Privileges
Breadcrumbs::for ('privileges.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Privileges', route('privileges.index'));
});

// Dashboard > Users
Breadcrumbs::for ('users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for ('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Create User', route('users.create'));
});

Breadcrumbs::for ('users.edit', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push('Edit ' . $user->name, route('users.edit', $user->id));
});

// Dashboard > Messages
Breadcrumbs::for ('messages.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Messages', route('messages.index'));
});

// Dashboard > Settings
Breadcrumbs::for ('settings.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Settings', route('settings.index'));
});

Breadcrumbs::for ('settings.edit', function ($trail, $setting) {
    $trail->parent('settings.index');
    $trail->push('Edit Setting', route('settings.edit', $setting->id));
});

Breadcrumbs::for ('settings.create', function ($trail) {
    $trail->parent('settings.index');
    $trail->push('Create Setting', route('settings.create'));
});

// Dashboard > Profile
Breadcrumbs::for ('profile.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('profile.index'));
});

Breadcrumbs::for ('profile.edit', function ($trail, $profile) {
    $trail->parent('profile.index');
    $trail->push('Edit Profile Data', route('profile.edit', $profile->id));
});

Breadcrumbs::for ('profile.create', function ($trail) {
    $trail->parent('profile.index');
    $trail->push('Create Profile Data', route('profile.create'));
});

// Dashboard > Pages
Breadcrumbs::for ('pages.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Pages', route('pages.index'));
});

Breadcrumbs::for ('pages.edit', function ($trail, $page) {
    $trail->parent('pages.index');
    $trail->push('Edit Page Data', route('pages.edit', $page->id));
});

Breadcrumbs::for ('pages.create', function ($trail) {
    $trail->parent('pages.index');
    $trail->push('Create Page', route('pages.create'));
});

// Dashboard > Personal Info
Breadcrumbs::for ('personal.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Personal Info', route('personal.index'));
});

Breadcrumbs::for ('personal.edit', function ($trail, $personalInfo) {
    $trail->parent('personal.index');
    $trail->push('Edit Personal Info', route('personal.edit', $personalInfo));
});

Breadcrumbs::for ('personal.create', function ($trail) {
    $trail->parent('personal.index');
    $trail->push('Create Personal Info', route('personal.create'));
});

// Dashboard > Language Skills
Breadcrumbs::for ('languages.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Language Skills', route('languages.index'));
});

Breadcrumbs::for ('languages.edit', function ($trail, $skill) {
    $trail->parent('languages.index');
    $trail->push('Edit Skill', route('languages.edit', $skill));
});

Breadcrumbs::for ('languages.create', function ($trail) {
    $trail->parent('languages.index');
    $trail->push('Create Skill', route('languages.create'));
});

// Dashboard > Skill Categories
Breadcrumbs::for ('categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Skill Categories', route('categories.index'));
});

Breadcrumbs::for ('categories.edit', function ($trail, $category) {
    $trail->parent('categories.index');
    $trail->push('Edit Skill Category', route('categories.edit', $category));
});

Breadcrumbs::for ('categories.create', function ($trail) {
    $trail->parent('categories.index');
    $trail->push('Create Skill Category', route('categories.create'));
});

// Dashboard > Skills
Breadcrumbs::for ('skills.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Skills', route('skills.index'));
});

Breadcrumbs::for ('skills.edit', function ($trail, $skill) {
    $trail->parent('skills.index');
    $trail->push('Edit Skill', route('skills.edit', $skill));
});

Breadcrumbs::for ('skills.create', function ($trail) {
    $trail->parent('skills.index');
    $trail->push('Create Skill', route('skills.create'));
});

// Dashboard > Experience
Breadcrumbs::for ('experiences.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Experiences', route('experiences.index'));
});

Breadcrumbs::for ('experiences.edit', function ($trail, $experience) {
    $trail->parent('experiences.index');
    $trail->push('Edit Job', route('experiences.edit', $experience));
});

Breadcrumbs::for ('experiences.create', function ($trail) {
    $trail->parent('experiences.index');
    $trail->push('Create Job', route('experiences.create'));
});

// Dashboard > Education
Breadcrumbs::for ('education.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Education', route('education.index'));
});

Breadcrumbs::for ('education.edit', function ($trail, $education) {
    $trail->parent('education.index');
    $trail->push('Edit Education', route('education.edit', $education));
});

Breadcrumbs::for ('education.create', function ($trail) {
    $trail->parent('education.index');
    $trail->push('Create Education', route('education.create'));
});

// Dashboard > Portfolio
Breadcrumbs::for ('portfolio.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Portfolio', route('portfolio.index'));
});

Breadcrumbs::for ('portfolio.edit', function ($trail, $portfolio) {
    $trail->parent('portfolio.index');
    $trail->push('Edit Portfolio', route('portfolio.edit', $portfolio));
});

Breadcrumbs::for ('portfolio.create', function ($trail) {
    $trail->parent('portfolio.index');
    $trail->push('Create Portfolio', route('portfolio.create'));
});

// Dashboard > Contact
Breadcrumbs::for ('contact.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Contact', route('contact.index'));
});

Breadcrumbs::for ('contact.edit', function ($trail, $contact) {
    $trail->parent('contact.index');
    $trail->push('Edit Contact', route('contact.edit', $contact));
});

Breadcrumbs::for ('contact.create', function ($trail) {
    $trail->parent('contact.index');
    $trail->push('Create Contact', route('contact.create'));
});

// Dashboard > Articles
Breadcrumbs::for ('blog.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Blog', route('blog.index'));
});

Breadcrumbs::for ('blog.edit', function ($trail, $slug) {
    $trail->parent('blog.index');
    $trail->push('Edit Article', route('blog.edit', $slug));
});

Breadcrumbs::for ('blog.create', function ($trail) {
    $trail->parent('blog.index');
    $trail->push('Create Article', route('blog.create'));
});

// Dashboard > Article Categories
Breadcrumbs::for ('category.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Article Categories', route('category.index'));
});

Breadcrumbs::for ('category.edit', function ($trail, $category) {
    $trail->parent('category.index');
    $trail->push('Edit Article Category', route('category.edit', $category));
});

Breadcrumbs::for ('category.create', function ($trail) {
    $trail->parent('category.index');
    $trail->push('Create Article Category', route('category.create'));
});

// Dashboard > Roles
Breadcrumbs::for ('roles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for ('roles.edit', function ($trail, $role) {
    $trail->parent('roles.index');
    $trail->push('Edit Role', route('roles.edit', $role));
});

Breadcrumbs::for ('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push('Create Role', route('roles.create'));
});

// Dashboard > Visitors
Breadcrumbs::for ('visitors.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Visitors', route('visitors.index'));
});
