<?php

test('it belongs to an employer', function () {
    
    // Organizar
    $employer = \App\Models\Employer::factory()->create();
    $job = \App\Models\Job::factory()->for($employer)->create([
        'employer_id' => $employer->id,
    ]);
    // Actuar y Afirmar
    expect($job->employer->is($employer))->toBeTrue();

});

test('it can have tags', function () {
    // Organizar
    $job = \App\Models\Job::factory()->create();
    

    // Actuar
    $job->tag('Frontend');

    // Afirmar
    expect($job->tags)->toHaveCount(1);
});