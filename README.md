# TaskPilot IA: Intelligent Project Management

TaskPilot IA is a professional task management solution powered by artificial intelligence, designed to assist small teams in structuring their workflow and prioritizing critical actions.

---

## Project Overview

The primary objective of this project is to provide a robust, AI-enhanced task management system while demonstrating excellence in modern software engineering practices. It serves as a comprehensive example of a production-ready Laravel application, emphasizing clean architecture, automated quality control, and rigorous version control management.

---

## Core Features

### Task Lifecycle Management
A full CRUD (Create, Read, Update, Delete) implementation for tasks, featuring:
*   Status tracking: To Do, In Progress, Completed.
*   Priority levels: Low, Medium, High, Urgent.
*   Deadline management with strict validation to prevent retrospective scheduling.

### AI-Powered Insights
Integrated intelligence that transforms raw task descriptions into actionable plans:
*   Automated Summarization: Concise overviews of complex tasks.
*   Actionable Sub-tasks: Decomposition of broad objectives into manageable steps.
*   Risk Identification: Proactive detection of potential project bottlenecks.
*   Effort Estimation: Data-driven time and resource forecasting.

### Intelligent Dashboard
A centralized command center providing real-time statistics and advanced filtering capabilities to monitor team progress and workload distribution.

---

## Technical Architecture

### Strategy Design Pattern
The application implements the Strategy Pattern for its AI integration, ensuring high decoupling and ease of extensibility. This architecture allows the system to switch between different AI providers at runtime without affecting the core business logic.

*   **TaskAdvisorInterface**: The contract defining the behavior of AI advisors.
*   **OpenAiTaskAdvisor**: A production-ready implementation communicating with the OpenAI API (gpt-4o-mini).
*   **DemoTaskAdvisor**: A deterministic implementation for development and demonstration purposes, ensuring stability without external API dependencies.

The active provider is managed via the `AI_PROVIDER` environment variable, demonstrating a flexible configuration-driven approach.

### Service Layer & Refactoring
Logic has been extracted into specialized services to maintain a lean controller layer:
*   **TaskStatsCalculator**: Centralized logic for dashboard analytics.
*   **OpenAiResponseTextExtractor**: Specialized parser for handling complex AI responses, improving maintainability and testability.

---

## Engineering Workflow

The project follows a professional Git workflow to ensure code integrity and clear history:
*   **Feature Branching**: All new capabilities are developed in isolated `feature/*` branches.
*   **Pull Requests**: Mandatory peer reviews and integration checks before merging into the main branch.
*   **Hotfix Management**: Critical issues, such as date validation bugs, are resolved through dedicated `hotfix/` branches.
*   **Versioning**: Final releases are marked with semantic tags (v1.0).

---

## Quality Assurance

### SonarCloud Integration
Continuous quality monitoring is performed via Sonar, focusing on:
*   Maintainability: Identification and resolution of code smells.
*   Reliability: Ensuring robust error handling and logical consistency.
*   Security: Protecting against common vulnerabilities.

### Testing Suite
The project includes a suite of unit and feature tests using PHPUnit to validate the core business logic and AI integration patterns.

---

## Team and Responsibilities

*   **Anouar (Lead Developer / Release Manager)**: Responsible for the core architecture, AI integration, strategy pattern implementation, and overall workflow management.
*   **Zakaria (Quality & Documentation Lead)**: Focused on testing, Sonar analysis, code refactoring, and the preparation of commercial and technical documentation.

---

## Installation and Setup

1.  **Clone the Repository**
    ```bash
    git clone <repository-url>
    cd gitprojectfinal
    ```

2.  **Environment Configuration**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3.  **Dependency Management**
    ```bash
    composer install
    npm install && npm run build
    ```

4.  **Database Initialization**
    ```bash
    touch database/database.sqlite
    php artisan migrate --seed
    ```

5.  **Execution**
    ```bash
    php artisan serve
    ```

---

## Project Deliverables

*   Structured Git Repository with clear history.
*   Functional MVP with AI integration.
*   Documented Architecture and Design Patterns.
*   Sonar Quality Report and resolved issues.
*   Commercial Offer and Final Presentation.

---

*This project was developed as part of a modern software engineering module.*
