# Architecture: magento-zf-duo_api_php

## Purpose

Magento's fork of Duo Security's PHP API client. Provides authenticated HTTP access to Duo's Auth, Admin, and Accounts APIs for two-factor authentication (2FA) integration.

## Directory Structure

```
src/
  Client.php          — Base HMAC-signed HTTP client: signs requests, handles retries with backoff
  Auth.php            — Duo Auth API: auth(), preauth(), enroll(), check(), ping()
  Admin.php           — Duo Admin API: user management, phone management, group management
  Accounts.php        — Duo Accounts API: child account management
  Requester.php       — HTTP requester interface (abstracts cURL)
  Curl_Requester.php  — Production cURL-based HTTP requester
  File_Requester.php  — File-based requester for testing (reads responses from fixture files)
  Sleep_Service.php   — Interface for sleeping between retries
  U_Sleep_Service.php — Production sleep implementation using usleep()
```

## Key Design Decisions

- **HMAC-SHA1 request signing**: Every request is signed with the integration secret key using HMAC-SHA1 over a canonical string of method, host, path, and sorted parameters
- **Retry with backoff**: The client retries on HTTP 429 (rate limit) and 5xx responses with exponential back-off using the injected `Sleep_Service`
- **Requester interface**: `Requester` and `File_Requester` allow testing without live Duo API calls

## Security Notes

- The integration key (ikey) and secret key (skey) must be kept confidential; they are equivalent to API credentials
- Requests are sent over HTTPS; do not disable SSL verification in production

## Extension Points

- Implement `Requester` to use a custom HTTP client (e.g., Guzzle)
- Implement `Sleep_Service` to mock delays in tests

## Dependency Flow

```
Auth / Admin / Accounts
  → Client (HMAC signing, retry logic)
  → Requester (Curl_Requester in production, File_Requester in tests)
  → Duo API endpoint (HTTPS)
```
