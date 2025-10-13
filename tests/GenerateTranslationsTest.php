<?php

it('can generate translation files', function () {
    $this->artisan('auto-translations:generate --force')
        ->assertSuccessful();

    expect(file_exists(resource_path('lang/en.json')))->toBeTrue();
});
