<?php

use Core\Validator;

it('validates a string', function () {
    expect(Validator::string('foobar'))->toBeTrue();
    expect(Validator::string(false))->toBeFalse();
    expect(Validator::string(''))->toBeFalse();
});

it('validates a string with a minimum length', function () {
    expect(Validator::string('foobar', 20))->toBeFalse();
});

it('validates an email', function () {
    expect(Validator::email('foobar'))->toBeFalse();
    expect(Validator::email('foobar@gmail.com'))->toBeTrue();
});

it('validates that a number is greater than a given amount', function () {
    expect(Validator::greaterThan(10, 100))->toBeFalse();
    expect(Validator::greaterThan(10, 10))->toBeFalse();
    expect(Validator::greaterThan(10, 5))->toBeTrue();
});
    