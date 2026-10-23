#!/usr/bin/python3
"""Apply bounded, idempotent compatibility fixes to a Cabinetsens release."""
from pathlib import Path
import re,sys,json
release=Path(sys.argv[1]).resolve(strict=True)
assert release.parent==Path('/var/www/cabinetsens/releases') and re.fullmatch(r'\d{14}',release.name)
replacements={
    'web/app/themes/bridge/css/stylesheet.css':[
        ('url("img/box_image_shadow.png")','radial-gradient(ellipse at center, rgba(0,0,0,.22) 0%, rgba(0,0,0,0) 70%)'),
        ('../images/prettyPhoto/facebook/default_thumbnail.gif','/app/plugins/js_composer/assets/lib/vendor/prettyphoto/images/prettyPhoto/facebook/default_thumbnail.gif')],
    'web/app/themes/bridge/css/stylesheet.min.css':[
        ('url(img/box_image_shadow.png)','radial-gradient(ellipse at center,rgba(0,0,0,.22) 0%,rgba(0,0,0,0) 70%)'),
        ('../images/prettyPhoto/facebook/default_thumbnail.gif','/app/plugins/js_composer/assets/lib/vendor/prettyphoto/images/prettyPhoto/facebook/default_thumbnail.gif')],
    'web/app/plugins/qode-news/assets/css/news-map.css':[
        ('../../../../../wp-includes/js/mediaelement/controls.svg','/app/themes/bridge/css/img/audio/controls.svg'),
        ('url(../../../../../wp-includes/js/mediaelement/background.png)','none')],
    'web/app/plugins/qode-news/assets/css/news-map.min.css':[
        ('../../../../../wp-includes/js/mediaelement/controls.svg','/app/themes/bridge/css/img/audio/controls.svg'),
        ('url(../../../../../wp-includes/js/mediaelement/background.png)','none')],
    'web/app/plugins/bridge-core/modules/shortcodes/shortcode-elements/cards-gallery/cards-gallery.php':[
        ("$image_original    = wp_get_attachment_image_src($id, 'full');\n            $image['url']",
         "$image_original    = wp_get_attachment_image_src($id, 'full');\n            if (!is_array($image_original) || empty($image_original[0])) {\n                continue; // The source gallery can contain deleted attachment IDs.\n            }\n            $image['url']")],
}
for asset in ['web/app/plugins/js_composer/assets/lib/vendor/prettyphoto/images/prettyPhoto/facebook/default_thumbnail.gif','web/app/themes/bridge/css/img/audio/controls.svg']:
    assert (release/asset).is_file()
changes=[]
prepared=[]
for name,pairs in replacements.items():
    p=release/name; assert p.resolve()==p and p.is_file()
    original=p.read_text(); text=original
    for old,new in pairs:
        if old not in text:
            assert new in text,(name,'Expected CSS marker changed')
            continue
        assert text.count(old)==1,(name,old,text.count(old))
        text=text.replace(old,new)
    prepared.append((p,original,text))
for p,original,text in prepared:
    if original!=text:
        p.write_text(text);changes.append(str(p.relative_to(release)))
print(json.dumps({'compatibility_files_updated':changes}))
