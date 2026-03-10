# Baseball in the Attic – Elementor Widget Plugin

A custom WordPress/Elementor plugin that turns the BITA page design into a modular set of editable widgets.

---

## What's included

| File | Purpose |
|---|---|
| `elementor-bita.php` | Main plugin — registers widgets, enqueues fonts + CSS |
| `assets/css/bita-global.css` | All design tokens (CSS variables) and shared component styles |
| `bita-kit.json` | Elementor Global Kit — import to set colours, fonts, and button defaults |
| `widgets/class-widget-topbar.php` | Top contact/social bar |
| `widgets/class-widget-hero.php` | Full-bleed hero with rotating image |
| `widgets/class-widget-journey.php` | Photo stack + bio text section |
| `widgets/class-widget-as-seen-in.php` | Logo grid with repeater rows |
| `widgets/class-widget-different-kind.php` | Two-column text + rotated card stack |
| `widgets/class-widget-pillars.php` | 4-up cream card grid |
| `widgets/class-widget-who.php` | 3×2 audience card grid |
| `widgets/class-widget-ready.php` | Split CTA section |
| `widgets/class-widget-footer.php` | Full footer with decorative card |

---

## Installation

1. **Upload the plugin**
   - Zip the `elementor-bita/` folder
   - In WP Admin → Plugins → Add New → Upload Plugin
   - Activate **Baseball in the Attic – Elementor Widgets**

2. **Import the Design Kit**
   - In WP Admin → Elementor → User Preferences → Kit Library → Import Kit
   - Choose `bita-kit.json`
   - This sets all global colours, typography presets, and button defaults

3. **Fonts** — the plugin auto-loads via Google Fonts on the front end:
   - Merriweather (400, 900)
   - Barlow Condensed (900)
   - Lexend (700)
   - Poppins (500)
   - *Hoefler Text* is a macOS/iOS system font. On Windows it falls back to Palatino → Book Antiqua → Georgia.

---

## Building the page

All widgets appear under the **Baseball in the Attic** category in the Elementor panel.

**Recommended page structure (top to bottom):**

```
[BITA – Top Bar]          ← use in Elementor Pro Header template
[Nav]                     ← build with Elementor Pro Nav widget or theme
[Site Banner]             ← plain Elementor Text widget, bg #86A9BA
────────────────────────────
[BITA – Hero]
[BITA – Journey]
[BITA – As Seen In]
[BITA – Different Kind]
[BITA – Pillars Grid]
[BITA – Who We Work With]
[BITA – Ready To Talk]
────────────────────────────
[BITA – Footer]           ← use in Elementor Pro Footer template
```

> **Elementor Pro note:** The Top Bar and Footer widgets work best as Theme Builder templates (Header / Footer) so they appear site-wide without being placed on every page.

---

## Widget quick reference

### BITA – As Seen In
Uses a **Repeater**. Each item has:
- Logo image
- Alt text
- Height (px)
- **Row number (1–5)** — logos with the same row number are grouped on one line

### BITA – Pillars Grid
Uses a **Repeater** (max 4 items). Renders a responsive 4-column grid that collapses to 2 on tablet and 1 on mobile.

### BITA – Who We Work With
Uses a **Repeater** (6 items recommended). Cards are automatically split into rows of 3.

### BITA – Footer
Separate controls for: brand name, decorative card image, nav links (repeater), phone, email, copyright, privacy/terms URLs, social icons image.

---

## Customisation

**Colours** — edit the CSS variables in `assets/css/bita-global.css` under `:root`, or override per-widget via Elementor's Advanced → Custom CSS tab.

**Fonts** — swap the Google Fonts URL in `elementor-bita.php` and update the `--bita-f-*` variables in `bita-global.css`.

**Layout widths** — breakpoints are defined at the bottom of `bita-global.css` in `@media` blocks.
