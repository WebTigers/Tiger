# CLAUDE.md

You're working in a **Tiger** app (created from the `webtigers/tiger` skeleton). Follow the
platform conventions before writing code:

@vendor/webtigers/tiger-core/AGENTS.md

App-specific notes:
- **This directory is yours** — edit freely. The framework lives in `vendor/` (Tiger-owned,
  replaced by `composer update`); never edit it, extend it.
- Build features as modules: `vendor/bin/tiger make:module <name>` scaffolds a live
  controller + `/api` service + ACL + views + language files under `application/modules/`.
- Secrets go in `application/configs/local.ini` (gitignored), never in committed files.
