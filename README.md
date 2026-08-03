# 🐅 Tiger
### Stop building apps. Start shipping businesses.
**The AI-native SaaS platform.**

Tell your AI what you want to sell — books, memberships, merch, a whole store — and Tiger ships it:
real payments, real accounts, real multi-tenant SaaS. Your AI already knows how to extend it, so what
it builds is a *business you own* — not disposable code that breaks on the next prompt.

- ⚡ From idea to a running app **in minutes** — one line, an app you can *talk to*, not a blank page.
- 💸 **Own it all.** Your Stripe, your customers, your data, your license. Keep 100%.
- 🔓 **Your license, not GPL.** (Ahem, WordPress.)
- 🧩 **No plugin hell, no build step.** It grows without growing into spaghetti.
- 🎛️ **Fully front-end agnostic.** Every screen is just data from one clean JSON API — bring React, Vue, Svelte, htmx, or plain HTML, drop in your assets, add your own endpoints. Tiger doesn't care.
- 🤖 **Built FOR AI, not just with it.** The architecture is *designed* so your AI naturally extends it — stop loading it up with 97 skills.

> **Tiger doesn't replace vibe coding — it gives it a real foundation.**

> **Under the hood** (for the engineers): multi-tenant from the ground up, zero-build, built on
> **[TigerCore](https://github.com/WebTigers/TigerCore)** — the framework it pulls into `vendor/` and
> updates via Composer — on **[TigerZF](https://github.com/WebTigers/TigerZF)**. Why it's built this
> way, agent-to-agent → **[WHY-TIGER.md](WHY-TIGER.md)**. Full docs →
> **[tiger.webtigers.com/docs](https://tiger.webtigers.com/docs)**.

> **Status: public beta** (`v0.1.0-beta`). Installable from Packagist today; the API may still shift between beta releases.

## Install a new Tiger app

```bash
# 1. Scaffold your app from the Tiger skeleton (this repo). Copies ONCE — it's YOURS.
#    (--stability=beta while Tiger is in beta; drop it once 1.0 ships)
composer create-project webtigers/tiger my-app --stability=beta
cd my-app

# 2. Configure secrets + database
cp application/configs/local.ini.dist application/configs/local.ini
#    → set DB creds and APPLICATION_ENV in local.ini
bin/tiger install:secrets          # generate the app crypto key + password pepper

# 3. Create the schema + your first org/owner
bin/tiger migrate                  # org, user, org_user, acl_*, … (additive-only)
bin/tiger install:admin            # the founding org + owner account

# 4. Wire the docroot's asset symlinks, then serve ./public
bin/tiger link:assets              # (re)create _theme / _tiger (failsafe on any host)
php -S localhost:8000 -t public    # or point Apache/nginx at ./public
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

## Deployment (any web server)

Point your server's docroot at `public/` and route every **non-file** request to
`index.php` (the front controller). Real files, directories, and the `_theme`/`_tiger`
symlinks are served directly — static assets never touch PHP.

- **Apache (default):** nothing to do — `public/.htaccess` ships with the routing and
  works out of the box on `AllowOverride FileInfo` (shared hosting, most MVPs). The cost
  is a ~microsecond per-request `.htaccess` lookup.
- **Apache (enterprise / high-traffic):** move the rules into your vhost with
  `AllowOverride None` (skips the per-request lookup) and delete `public/.htaccess`.
  See [`deploy/apache-vhost.conf.example`](deploy/apache-vhost.conf.example).
- **nginx / Caddy / FrankenPHP:** these don't read `.htaccess`; use the equivalent
  front-controller config — [`deploy/nginx.conf.example`](deploy/nginx.conf.example),
  [`deploy/Caddyfile.example`](deploy/Caddyfile.example).

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

Built by WebTigers. Licensed under `BSD-3-Clause`, matching TigerZF.
