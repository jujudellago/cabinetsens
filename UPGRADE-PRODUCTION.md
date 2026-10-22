# Production upgrade brief — 2026-10 (PHP 8.5 / WordPress 7.1)

Branch: `upgrade/2026-10-php85`. Validated locally on macOS with PHP 8.5.12 (FPM): all 115 published
pages/posts return 200 (2 intentional 302 redirects), no PHP fatals or syntax errors, `composer audit` clean.

## Target versions

| Component | Before | After |
|---|---|---|
| PHP | ≥ 5.6 | **8.5** (composer `platform.php` pinned to 8.5.12, requires `>=8.3`) |
| WordPress | johnpbloch/wordpress 6.3.1 | roots/wordpress 7.1.3 (DB version 55853 → 61833) |
| Bridge theme | 29.6 | 30.9.1 (ThemeForest package, 2026) |
| WPBakery (js_composer) | 7.0 | 9.0.1 |
| Slider Revolution | 6.6.14 | 7.1.8 (creates `wp_revslider_*7` tables on first load) |
| LayerSlider | 7.7.7 | 8.4.1 |
| Bridge Core / Qode add-ons | 3.0.9 / various | 3.3.5.1 / versions from the theme package |
| phpdotenv / oscarotero/env | 2.6 / 1.2 | 5.7 / 2.1 (`config/application.php` updated) |
| Capistrano | 3.16.0 (Bundler 2.1.0) | 3.20.1 (Bundler 4, net-ssh 8) |

## Server prerequisites (same server as clockart)

- PHP **≥ 8.3** (8.5 recommended) for both php-fpm and the CLI used by Capistrano/Composer.
  Composer's platform check returns HTTP 500 on older PHP.
- WP-CLI ≥ 2.12.

## Deploy

0. Add `RSSSL_KEY` to `shared/.env` **before** deploying (Really Simple SSL 9.x encryption key, read by
   `config/application.php`). Without it the plugin writes the key into `web/wp-config.php` inside the release
   and deletes its DB copy, so the next deploy loses it. Generate once: `openssl rand -base64 48 | tr -dc A-Za-z0-9 | head -c 64`.
   If production already has a `rsssl_main_key` site option, use that value instead: `wp option get rsssl_main_key`.
1. Back up the production DB and `shared/web/app/uploads`.
2. Merge the branch to `master`, push, then `bundle exec cap production deploy`.
3. On the server, in `current`:
   ```sh
   wp core update-db
   wp cache flush
   ```
4. Log in to WP Admin once: Slider Revolution and WPBakery run their own DB migrations on admin load.
   Check Slider Revolution → sliders render on the home page.
5. Smoke test: home, /english/, /autres/medias/, contact form, /wp/wp-login.php. Check the PHP-FPM log.

## Removed

- `obfuscate-email`, `stop-spam-comments`, `google-no-captcha-recaptcha`: closed on wordpress.org (no longer
  installable). The first two were active; WordPress deactivates missing plugins automatically.
- Unused, not updatable: `advanced-custom-fields-pro` 5.7.6 (no field groups) and `vc-extensions-bundle` 3.6.5
  (shortcodes only in 2018 revisions). Both were active; WordPress deactivates them automatically.
- Inactive and unmaintained: `qode-instagram-widget`, `qode-twitter-feed`, `essential-grid`, `otw-blog-manager`,
  `trx_addons`, `uxbarn-portfolio-lite`, themes `jeanne` and `callie-britt`.
- `roots/wp-password-bcrypt`: WordPress ≥ 6.8 hashes with bcrypt natively and still verifies existing `$2y$`
  hashes, so nobody needs to reset a password.

## Local customisation carried over

- `web/app/themes/bridge/css/style_dynamic_callback.php`, `css/style_dynamic_responsive_callback.php`,
  `js/default_dynamic_callback.php`: load `wp/wp-load.php` (Bedrock layout). Re-apply after every Bridge update.
- `web/app/themes/bridge/css/style_dynamic*.css` and `js/default_dynamic.js` are generated from the Bridge options
  but committed (each deploy replaces the theme folder). They are kept as production serves them. Note: the
  options in the DB say 40/35/30px headings while the committed CSS has 35/30/27px, so saving Bridge options
  will change the look. Regenerate locally, check, and commit if a change is intended.

## Still to decide

- `envato-market` 2.0.1 → 2.0.14 available (https://envato.github.io/wp-envato-market/dist/envato-market.zip).
- `web/wp-config.php` defines `WP_CACHE` true ("Added by W3 Total Cache") although W3TC is inactive. Harmless
  without `advanced-cache.php`, but can be removed.
