# Deploying cabinetsens to teerak

Production: **https://www.cabinetsens.ch**, on the DigitalOcean droplet **teerak** (`201.79.15.11`), since 22 Oct 2026.
Full server and site docs: `juju_brain` repo, `yabo-concept/hosting/digitalocean/README.md` and `yabo-concept/hosting/cabinetsens/info.md`.

| | |
|---|---|
| Capistrano stage | **`teerak`** only. `production` is the old compromised server (shatzi); never use it. |
| Branch deployed | **`master`**, from GitHub, not your local checkout. Push first. |
| Bundler / Ruby | `4.0.23` / Ruby 3.4.5 |
| Server base | `/var/www/cabinetsens` (web root `current/web`) |
| WP-CLI on server | `/usr/local/bin/teerak-wp cabinetsens …` |

## One-time setup on a new machine

1. **Ruby:** install Ruby 3.4.5 (asdf), then `gem install bundler -v 4.0.23` and `bundle _4.0.23_ install`.
2. **SSH key for teerak:**
   - Create a dedicated key for this machine: `ssh-keygen -t ed25519 -f ~/.ssh/id_ed25519_teerak`.
   - Ask julien to add its `.pub` to `deploy`'s `authorized_keys` on teerak.
   - Don't copy keys between machines, and never enable agent forwarding.
3. **`~/.ssh/config`:**
   ```
   Host teerak 201.79.15.11
     HostName 201.79.15.11
     User deploy
     IdentityFile ~/.ssh/id_ed25519_teerak
     IdentitiesOnly yes
     PubkeyAcceptedAlgorithms ssh-ed25519
     HostKeyAlgorithms ssh-ed25519
   ```
   On the first connection, check that the host key fingerprint is `ED25519 SHA256:ouJ/NXRapUNourbPndaQ+SNNaSxBOVRMuc4QtMuzMho`.
4. **`config/secrets.yml`** (git-ignored; `config/deploy.rb` won't load without it). It contains only URLs: `production_url: https://www.cabinetsens.ch`, `dev_url: http://cabinetsens.yabo-sites.loc`, plus `staging_url` and `topolina_url` (unused by teerak). Copy it from the main Mac or recreate it.

## Deploy

```sh
git pull                                   # on master
git push origin master
export BUNDLE_FROZEN=true
bundle _4.0.23_ exec cap teerak doctor:servers   # must list only deploy@201.79.15.11
bundle _4.0.23_ exec cap teerak deploy
# pinned: TEERAK_REVISION=<full 40-char pushed sha> bundle _4.0.23_ exec cap teerak deploy
```

**What the stage does:**
- `composer install --no-dev` from `composer.lock`.
- Links `shared/.env` and the uploads.
- Uploads the mu-plugins below and runs the asset fixes.
- Runs `sudo /usr/local/sbin/teerak-prepare-release cabinetsens <release>`, which must succeed, then publishes.

**Files used at deploy** (keep them in git, they are part of what runs in production):
- `config/deploy/teerak-runtime-filesystem.php` → `001-cabinetsens-runtime-filesystem.php`: `FS_METHOD=direct` (code stays read-only), and a CF7/Bootstrap style fix.
- `config/deploy/teerak-mail-disabled.php` → `002-teerak-mail-disabled.php`: mail fails while `shared/.mail-disabled` exists.
- `config/deploy/teerak-asset-fixes.py`: idempotent fixes to obsolete Bridge/Qode/WPBakery CSS asset references, and the Bridge gallery's deleted-image guard. It runs on each release.
- `config/deploy/teerak-preview-guard.php`: only used if `shared/.preview-mode` exists.

**WP-CLI through Capistrano:** `bundle _4.0.23_ exec cap teerak 'wpcli:run[core version]'`. The teerak stage replaces the duplicate gem and `lib/` task, so it runs once. Or call `ssh teerak /usr/local/bin/teerak-wp cabinetsens core version` directly.

**Check after deploying:** `curl -sI https://www.cabinetsens.ch/ | grep -i x-teerak-site`

## Site specifics

- `shared/.env` on the server holds `RSSSL_KEY`, which Really Simple SSL uses to encrypt its settings. Never replace or regenerate it, and never let it be written into `web/wp-config.php`.
- The Bridge `style_dynamic` / `default_dynamic` files are committed on purpose.
- DNS is at Kreativmedia (Plesk), not Cloudflare.

## Rules

- Never run `composer update` on the server.
- Never chmod or chown release code, and never run WordPress as root.
- Don't use the old DB/uploads sync tasks against production.
- Commit only intended files, never `git add .`. This checkout has local work in progress (`bridge-child/header.php`, `lib/`, `Gemfile`…) that is not deployed.
- Email is intentionally disabled on the site.

## Pulling and pushing data

- `bundle _4.0.23_ exec cap teerak wpcli:db:pull`: production DB → local DB (replaces the local DB, rewrites URLs). Safe for production.
- `bundle _4.0.23_ exec cap teerak wpcli:uploads:rsync:pull`: production uploads → local.
- `wpcli:db:push` / `wpcli:uploads:rsync:push` **overwrite production**. On teerak they ask you to type `cabinetsens` first; the gem also saves a production DB backup in `config/backups/` before asking. Don't push a stale local DB.
- The stage maps `wp` to `teerak-wp cabinetsens` only on the server; local steps use your local `wp`.
