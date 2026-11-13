# Security Policy

## Reporting a vulnerability

Email **security@webtigers.com**. Please don't open a public GitHub issue for a security problem.

This repository is the Tiger **skeleton** (`webtigers/tiger`) — the app scaffold you create a project from.
The platform code, and nearly every security fix, lives in **TigerCore** (`webtigers/tiger-core`). Its
[security policy](https://github.com/WebTigers/TigerCore/blob/main/SECURITY.md) covers what to include in a
report, which versions are supported, and how to update.

## Staying up to date

- **From the admin:** Modules › Updates updates TigerCore and your installed modules in place.
- **With Composer:** `composer update webtigers/tiger-core`, then `bin/tiger migrate`.

A security fix ships as a new TigerCore release; you don't need a new skeleton version to get it.
