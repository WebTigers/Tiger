# Tiger

A **1-click SaaS platform** built on [TigerZF](https://github.com/WebTigers/TigerZF)
(Zend Framework 1, modernized for PHP 8.1–8.5).

Tiger gives you the boring-but-essential SaaS substrate — multi-tenant orgs, users,
memberships, roles/ACL, auth — so you build *product*, not plumbing.

> **Status: greenfield.** This README describes the *target* install experience we're
> building toward. Nothing here works yet.

## Install a new Tiger app

```bash
# 1. Scaffold your app from the Tiger skeleton (this repo). Copies ONCE — it's YOURS.
composer create-project webtigers/tiger my-app
cd my-app

# 2. Configure your database + environment
cp application/configs/application.ini.dist application/configs/application.ini
#    → set DB creds (or an AWS Secrets Manager key) and APPLICATION_ENV

# 3. Run platform migrations (creates org, user, org_user, acl_* tables)
bin/tiger migrate

# 4. Create your first org + owner account
bin/tiger install:admin

# 5. Point a web server at ./public (the docroot). Locally:
php -S localhost:8000 -t public
```

Open `http://localhost:8000` — you're running Tiger.

## What just happened

- `create-project` copied the **skeleton** (`public/`, `application/Bootstrap.php`,
  `application/configs/`, an example module) into `my-app/`. **This is yours** — Composer
  never touches it again.
- It pulled the **framework** into `vendor/` (Tiger-owned, updatable):
  - `webtigers/tigerzf` — the ZF1 engine (`Zend_*`)
  - `webtigers/tiger-core` — the platform: the `Tiger_*` kernel + org/user/membership/ACL
    substrate + the default-namespace core + core assets
- A composer post-install script symlinked core assets into your docroot:
  `public/_tiger → vendor/webtigers/tiger-core/public`.

## The ownership rule (why updates are safe)

- **`vendor/` is Tiger-owned.** `composer update` replaces it in place.
- **Everything else is yours.** Composer *cannot* write outside `vendor/`.
- **Extend, don't edit:** add modules under `application/modules/`, drop overrides into
  the default namespace in `application/`, layer config with `.ini` files that merge over
  the defaults. Nothing *stops* you editing a Tiger-owned file in `vendor/` — but it
  vanishes on the next `composer update`. Keep your changes out of `vendor/` and they live
  forever.

## Update the platform

```bash
composer update webtigers/tiger-core
bin/tiger migrate        # apply new core migrations (additive-only — never destructive)
```

Your app code, modules, config, and customizations are untouched.

## Build a feature

```bash
bin/tiger make:module billing
```

Creates a self-registering `application/modules/billing/` (Bootstrap + service +
`routes.ini`/`acl.ini`/`navigation.ini`). It plugs into Core via convention — AJAX routes
to `/api/:module/:service/:action`, ACL gates every access — and **never touches Core**.

## Architecture (in one breath)

- **Core = the default (module-less) namespace, shipped from `webtigers/tiger-core`.**
  Org (tenant, with `parent_org_id`), User (thin), `org_user` (membership = the tenancy
  boundary *and* the role carrier), roles/ACL, auth, and the `Tiger_*` kernel.
- **Modules = `application/modules/*` = everything you add.** Additive, self-registering,
  ACL-gated, service-dispatched.
- **Roles live on the membership** (`org_user`), so a user can be `admin` in one org and
  `viewer` in another. The absence of an `org_user` row *is* the cross-tenant denial.

---

Built by WebTigers. Licensed under `(MIT AND BSD-3-Clause)`, matching TigerZF.
