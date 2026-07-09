# Changelog

All notable changes to the **Tiger skeleton** (`webtigers/tiger`) — the scaffold you create a
new app from. Follows [Keep a Changelog](https://keepachangelog.com/) + [SemVer](https://semver.org/).

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
