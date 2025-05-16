# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://git.d3data.de/D3Public/guzzleFactory/compare/2.0.0...rel_2.x)

## [2.0.0](https://git.d3data.de/D3Public/guzzleFactory/compare/1.2.0...2.0.0) - 2025-02-10
### removed
- creating logger via LoggerFactory - add configured logger using the `addConfiguredLogger` method
- OXID dependend code - can use from third party LoggerFactory library instead

## [1.2.0](https://git.d3data.de/D3Public/guzzleFactory/compare/1.1.0...1.2.0) - 2025-02-10
### Added
- special log handlers
### Changed
- use [LoggerFactory](https://packagist.org/packages/d3/logger-factory) instead of internal methods

## [1.1.0](https://git.d3data.de/D3Public/guzzleFactory/compare/1.0.0...1.1.0) - 2025-01-27
### Added
- combined OXID logger and file logger
  - errors are written here (expected behaviour)
  - all error level are written to custom log file

## [1.0.0](https://git.d3data.de/D3Public/guzzleFactory/releases/tag/1.0.0) - 2025-01-01
### Added
- initial implementation
    - can create a custom Guzzle instance
      - "accept" option
      - "contentType" option
      - "userAgent" option
      - file logger option (rotating or static)
        - message formatter option (without sensitive or full content)
      - OXID eShop logger option
