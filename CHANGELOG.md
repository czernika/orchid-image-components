# Changelog

## v2.2.0 - 2025-03-01

- Added Laravel 12 support

## v2.1.5 - 2024-06-30

- fix: fit properties were not applied because of height

## v2.1.4 - 2024-06-16

- fix: add updated styles

## v2.1.3 - 2024-06-16

- fix: set image width variable instead of width
- refactor: images and avatars are now responsive

## v2.1.2 - 2024-06-12

- fix: composer version mismatch

## v2.1.1 - 2024-06-12

- fix: resolve null url values for galleries by adding placeholder method

## v2.1.0 - 2024-06-12

- refactor: default value for `aspect-ratio` property for Gallery and Lightbox components changed from `4/3` to `auto`

## v2.0.6 - 2024-03-20

- Laravel 11 support

## v2.0.5 - 2024-02-28

**Full Changelog**: https://github.com/czernika/orchid-image-components/compare/v2.0.4...v2.0.5

## v2.0.4

- **FEAT**: added `width()` for Gallery and Carousel
- **FEAT**: added `caption()` for Image

## v2.0.3

- **FIX**: fixing error when empty value was not shown when relation has `withDefault()`

## v2.0.2

- **CHORE**: updated deps
- **DOCS**: added docs

## v2.0.1

- **refactor**: change auto-fit layout for galleries with less than 2 images

## v2.0.0

- **refactor**: changed code base
- **FEAT**: new options almost for every component
- **FEAT**: added JS options for interactive elements such as Lightbox and Carousel
- **TESTS**: covered more use cases
