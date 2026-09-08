# Changelog

All notable changes to the **Tiger skeleton** (`webtigers/tiger`) — the scaffold you create a
new app from. Follows [Keep a Changelog](https://keepachangelog.com/) + [SemVer](https://semver.org/).

## [1.0.8] — 2026-09-08

**Refreshed install bundle.** No skeleton code changed — republishes the vendored full-app bundle
against **tiger-core 1.5.8** (the Update button no longer installs from a stale cache, Add New in the
Modules nav, and the smoke suite now verifies a page's referenced assets actually serve).

## [1.0.7] — 2026-09-08

**Security bundle refresh.** No skeleton code changed — republishes the vendored full-app bundle
against **tiger-core 1.5.7**, which fixes five authorization defects (suspended accounts/memberships
still authorizing, cross-tenant media access, CMS menu `org_id` trust, and MCP token policy clearing).

## [1.0.6] — 2026-09-08

**Refreshed install bundle.** No skeleton code changed — republishes the vendored full-app bundle
against **tiger-core 1.5.6**, which completes the one-click self-update fix (opcache reset after the
vendor swap + health-probe retries).

## [1.0.5] — 2026-09-08

**Refreshed install bundle.** No skeleton code changed — republishes the vendored full-app bundle
against **tiger-core 1.5.5**, which restores the one-click core update on shared hosting (it had
always rolled back).

## [1.0.4] — 2026-09-08

**Refreshed install bundle.** No skeleton code changed — republishes the vendored full-app bundle
against **tiger-core 1.5.4** (the admin SITE link and the `/get-tiger` download button).

## [1.0.3] — 2026-09-07

**Refreshed install bundle.** No skeleton code changed — republishes the vendored full-app bundle
against **tiger-core 1.5.3**, which is what lets Tiger install on **MySQL** (migration 0041 used a
MariaDB-only `information_schema` column and killed the install on MySQL hosts).

## [1.0.2] — 2026-09-07

**Refreshed install bundle.** No skeleton code changed — this republishes the vendored full-app
bundle against **tiger-core 1.5.2**, which is what lets Tiger install on hosts that block
`symlink()` (much of hardened shared/cPanel hosting). The 1.0.1 bundle vendored 1.5.1 and would
still fail at "wiring assets" on those hosts.

## [1.0.1] — 2026-09-07

**Refreshed install bundle.** No skeleton code changed — this release exists to republish the
vendored full-app bundle (`tiger-1.0.1.zip`) against the current framework.

### Fixed
- The bundle attached to `1.0.0` vendored **`webtigers/tiger-core` v1.0.0**, so a browser install
  landed five releases behind (missing 1.1 → 1.5.1). The skeleton's `^1.0` constraint always
  resolved forward; only the built artifact was frozen. Rebuilt, it now vendors **1.5.1**.

## [1.0.0] — 2026-08-24

**Tiger 1.0.** The skeleton now publishes a stable tag, so a new app is:

```bash
composer create-project webtigers/tiger my-app
```

### Changed
- `minimum-stability` is now `stable` (was `beta`), and `webtigers/tiger-core` is required at
  `^1.0` (was `>=0.1.0-beta <1.0.0`, which would have excluded the 1.0.0 framework release).
- Install docs drop `--stability=beta` — it is no longer needed.

## [0.1.1-beta] — 2026-07-09

### Changed
- **`webtigers/tiger-core` constraint widened to the beta line** (`>=0.1.0-beta <1.0.0`, was
  `^0.1.0-beta`). Composer's `0.x` caret locks the minor, so `^0.1.0-beta` would refuse
  `tiger-core` `0.2.x`; the range keeps `composer update` working across beta minors (the `@api`
  isn't frozen until 1.0, and updates are opt-in). At 1.0 this returns to a normal caret.

## [0.1.0-beta.3] — 2026-07-09

### Changed
- **On Packagist.** Dropped the VCS `repositories` block — `webtigers/tiger-core` (and tigerzf)
  now resolve straight from Packagist. Install is a one-liner:
  `composer create-project webtigers/tiger my-app --stability=beta`. README install steps
  updated to match (`local.ini.dist`, `install:secrets`, `link:assets`).

## [0.1.0-beta.2] — 2026-07-09

### Changed
- **`public/index.php` self-locates the application root** — auto-detects whether the app sits
  beside `public/` (dev / VPS) or ABOVE the docroot (cPanel / shared hosting: `~/public_html` +
  `~/tiger`), via `TIGER_ROOT` env → a `.tiger-root` marker → co-located → split. Makes the same
  shim work on cPanel out of the box; clean 500 with guidance if nothing resolves.

## [0.1.0-beta.1] — 2026-07-09

First public **beta** of the app skeleton for the Tiger platform.

### Added
- Skeleton layout: thin `public/index.php` shim, `Bootstrap` extending
  `Tiger_Application_Bootstrap`, `custom.php` hook, `application/` (configs, modules), `library/`
  (`App_*`) + `src/` (`App\`), and `deploy/` server-config references.
- `public/.htaccess` — the zero-config front-controller default (works on any Apache with
  `AllowOverride FileInfo`; static/symlink passthrough; dotfile denial with an ACME exception).

### Changed
- **Consumes `webtigers/tiger-core` `^0.1.0-beta`** from its GitHub VCS repository (tigerzf
  resolves from Packagist transitively) — replacing the local dev path-symlink. `minimum-stability`
  is `beta` with `prefer-stable`.

### Install (beta)
```
git clone https://github.com/WebTigers/Tiger my-app && cd my-app
composer install
cp application/configs/local.ini.dist application/configs/local.ini   # then fill in
vendor/bin/tiger install:secrets && vendor/bin/tiger migrate && vendor/bin/tiger install:admin
```
> `composer create-project webtigers/tiger` becomes available once the packages are listed on
> Packagist (see the project README / release notes).

[0.1.1-beta]: https://github.com/WebTigers/Tiger/releases/tag/v0.1.1-beta
[0.1.0-beta.3]: https://github.com/WebTigers/Tiger/releases/tag/v0.1.0-beta.3
[0.1.0-beta.2]: https://github.com/WebTigers/Tiger/releases/tag/v0.1.0-beta.2
[0.1.0-beta.1]: https://github.com/WebTigers/Tiger/releases/tag/v0.1.0-beta.1
