# Hoogah V4 Redesign — Handoff to Ashish

**Date:** 2026-04-29
**From:** Allen
**Status:** Drafts saved, live site untouched, pending iteration + final QA before deploy

---

## What this is

Joe Lovett (Hoogah co-founder) sent design feedback. We did a V4 redesign of the homepage + 5 inner pages. All drafts live on disk only — **nothing is on hoogah.co yet**.

You're picking up to finish polish and ship it live.

## Files (all in repo root)

| File | Purpose |
|------|---------|
| `new-index.html` | Homepage redesign |
| `new-how-it-works.html` | How It Works |
| `new-our-belief.html` | Our Belief |
| `new-use-cases.html` | Use Cases |
| `new-pricing.html` | Pricing |
| `new-faq.html` | NEW — FAQ page (didn't exist before) |
| `css/v4-style.css` | V4 design system + Joe-compliant additions |

These are **untracked in git right now**. First step: commit them to a `v4-redesign` branch so you can work on them without touching live.

## Run locally

```bash
cd /path/to/Hoogah-almost-final-v1
python3 -m http.server 8888
# open http://localhost:8888/new-index.html
```

Test at 1440×900 (desktop), 820×1180 (tablet), 390×844 (mobile).

## Design rules (Joe's feedback — DO NOT BREAK)

- **Light backgrounds by default**, dark used sparingly (CTA section, one featured card per page)
- **Highlight box pattern** — soft cream/lime tinted boxes for key callouts
- **Lime CTAs on light backgrounds** (`#c8ff00` on cream), dark CTAs only in dark sections
- **Real photos** in the homepage photo spread (`9:00 AM · DOORS OPEN`), not stock-feeling stuff
- **NO big serif quote marks** (the heavy `"` characters). Use thin 48px lime horizontal rules above quotes instead. Allen called these out specifically as overflowing — don't add them back.
- **Short copy.** Joe is allergic to walls of text.
- **Same V3 fonts/colors**: Space Grotesk (headings), DM Sans (body), navy `#1a0a5e`, magenta `#a8198b`, cream `#faf8f5`, lime `#c8ff00`. NOT the older neo-brutalist V1.

## What's already done

- 6 pages built + new FAQ page
- Mobile nav (hamburger <1024px, sticky lime CTA after 500px scroll)
- Animated stat count-up (76% / 68% / 52% / $0) on homepage
- Editorial flourishes: kicker line, big faded chapter numbers (01/02/03), lime corner accents on images, asymmetric photo spread, POV cards (organizer/attendee), pullquote with lime rule
- 2-tier pricing ($20 + $750)
- Team section (Khushi + Joe)
- 16-Q FAQ accordion
- Reduced-motion accessibility respected
- Zero console errors at 1440 / 820 / 390

## What's open (your queue)

1. **Final QA pass** — re-test all 6 pages at 3 viewports, fix anything broken
2. **Copy review** — read through with fresh eyes; tighten anything wordy. Joe will probably want a final pass before launch.
3. **Asset check** — confirm every `<img>` actually loads. The photo spread on homepage references real photos in `images/` — verify they exist or swap.
4. **GSAP reliability** — `.gs-hero-*` classes are still hidden until GSAP reveals them. If GSAP fails to load on slow connections, the hero is invisible. Add a fallback (e.g. `setTimeout` to force-reveal after 3s, or remove the initial hide and let GSAP override).
5. **Book a Demo** flow — `book-demo.html` is the existing live page. Confirm the V4 CTAs still link to it correctly.
6. **Anything Allen flags** when he reviews

## Deploy path (DO NOT push without Allen's go-ahead)

When approved:

1. Rename:
   - `new-index.html` → overwrite `index.html`
   - `new-how-it-works.html` → overwrite `how-it-works.html`
   - `new-our-belief.html` → overwrite `our-belief.html`
   - `new-use-cases.html` → overwrite `use-cases.html`
   - `new-pricing.html` → overwrite `pricing.html`
   - `new-faq.html` → keep as `faq.html` (NEW page)
2. Update internal links across all pages: every `href="new-*.html"` → strip `new-` prefix
3. Confirm `css/v4-style.css` is the active stylesheet (or merge into `styles.css`, your call)
4. Commit on `v4-redesign` branch, open PR to `main`
5. **Ping Allen for final review** before merging
6. Merging to `main` auto-deploys to hoogah.co via WordPress.com Business + GitHub integration

## Repo

- **GitHub:** `allenanant/hoogah-almost-final-v1` (private)
- **Live:** https://hoogah.co
- **Branch you'll work on:** `v4-redesign` (create it from `main`)
- **Auto-deploy trigger:** push/merge to `main` only

## Hard guardrails

- **Don't push to `main`.** Only Allen merges.
- **Don't change `index.html`, `how-it-works.html`, `our-belief.html`, `use-cases.html`, `pricing.html`** until rename step at deploy time. Those are live.
- **Don't add new dependencies** (no React, no build step). It's static HTML + vanilla JS + GSAP CDN. Keep it that way.
- **Don't swap fonts or colors.** V3/V4 system is locked.

## Questions → Allen

WhatsApp / Slack — same as usual.
