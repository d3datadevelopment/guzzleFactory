# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://git.d3data.de/D3Public/guzzleFactory/compare/1.0.0...rel_1.x)
### Added
- combined OXID logger and file logger
  - errors are written here (expected behaviour)
  - all error level are written to custom log file

## [1.0.0](https://git.d3data.de/D3Public/guzzleFactory/releases/tag/1.0.0) - 2025-01-01
### Added
- initial implementation
    - can create am cutom Guzzle instance
      - "accept" option
      - "contentType" option
      - "userAgent" option
      - file logger option (rotating or static)
        - message formatter option (without sensitive or full content)
      - OXID eShop logger option
