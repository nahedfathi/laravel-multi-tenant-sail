Laravel Multi‑Tenant SaaS (Sail + Passport + Horizon + Elasticsearch)

implementing multi‑tenancy with isolated databases, API authentication via Laravel Passport, asynchronous queues with Redis + Horizon,
and full‑text search via Elasticsearch. The stack runs locally using Laravel Sail (Docker Compose).

It uses [stancl/tenancy](https://tenancyforlaravel.com/) for tenant isolation.

Features

Laravel Sail for consistent Dockerized dev environment (PHP, MySQL, Redis, Elasticsearch, Horizon).

Multi‑tenancy (per‑tenant DB) with dynamic connection resolution.

Laravel Passport for OAuth2 access tokens (tenant‑aware auth flows).

Queues (Redis) with Laravel Horizon dashboard & metrics.

Event‑driven architecture: domain events dispatched after response to keep requests fast.

Elasticsearch sync for Job entities via queued listeners/jobs.

******
Central DB: stores tenants/domains/metadata.

Tenant DBs: each tenant has its own schema and data.

Job flow: Controller creates Job → dispatches JobCreatedEvent after response → queued Listener/Job syncs to Elasticsearch.

Available APIs: user register , user login , user profile , tenant information , list jobs , create jobs

******
installations

-git clone git@github.com:nahedfathi/laravel-multi-tenant-sail.git

-cd laravel-multi-tenant-sail

-./vendor/bin/sail up -d

-./vendor/bin/sail artisan migrate

-./vendor/bin/sail artisan db:seed --class=TenantSeeder

-./vendor/bin/sail artisan tenants:migrate
