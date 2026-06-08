# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-06-08

### Added
- Complete Task CRUD (Title, Description, Status, Priority, Due Date).
- Dashboard with status and priority filters.
- AI Task Suggestion feature with persistence.
- Strategy Pattern for AI providers (Demo and OpenAI).
- Dedicated service for Task Statistics (`TaskStatsCalculator`).
- Dedicated extractor for OpenAI responses (`OpenAiResponseTextExtractor`).

### Fixed
- Hotfix: Added validation to prevent due dates in the past.
- Sonar maintainability issues regarding controller logic and AI parsing.

### Security
- API keys moved to environment variables.

## [0.2.0] - 2026-06-05
- Added AI integration and Strategy Pattern.

## [0.1.0] - 2026-06-01
- Initial MVP with Task CRUD.
