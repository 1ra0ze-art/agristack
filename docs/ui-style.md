# UI Style Guide — AgriStack

## Design Direction
**Organic-Industrial** — earthy agricultural tones grounded in trust and professionalism. Rwanda's green hills meet marketplace clarity.

## Color Palette

| Role | Variable | Hex | Usage |
|---|---|---|---|
| Primary | `--green-dark` | `#1A5C38` | Nav, CTAs, headers |
| Secondary | `--green-mid` | `#2E8B57` | Buttons, accents |
| Accent | `--gold` | `#D4A017` | Highlights, badges |
| Background | `--cream` | `#F9F5EF` | Page background |
| Surface | `--white` | `#FFFFFF` | Cards, modals |
| Text Dark | `--text-dark` | `#1C1C1C` | Body text |
| Text Muted | `--text-muted` | `#6B7280` | Labels, captions |
| Danger | `--red` | `#DC2626` | Errors, delete |
| Warning | `--amber` | `#F59E0B` | Pending status |
| Info | `--blue` | `#2563EB` | Info, collected status |

## Typography

- **Headings**: `'Playfair Display', serif` — dignity and agricultural heritage
- **Body/UI**: `'DM Sans', sans-serif` — clean, modern, readable
- **Monospace** (audit log/codes): `'JetBrains Mono', monospace`

| Element | Font | Size | Weight |
|---|---|---|---|
| H1 | Playfair Display | 2rem | 700 |
| H2 | Playfair Display | 1.5rem | 600 |
| H3 | DM Sans | 1.25rem | 600 |
| Body | DM Sans | 1rem | 400 |
| Small/Caption | DM Sans | 0.875rem | 400 |
| Button | DM Sans | 0.9rem | 600 |

## Status Badge Colors

| Status | Background | Text |
|---|---|---|
| Pending | `#FEF3C7` | `#92400E` |
| Approved | `#D1FAE5` | `#065F46` |
| Collected | `#DBEAFE` | `#1E40AF` |
| Rejected | `#FEE2E2` | `#991B1B` |

## Component Patterns

### Cards
- Border-radius: 12px
- Box-shadow: `0 2px 8px rgba(0,0,0,0.08)`
- Padding: 24px
- Hover: slight lift `translateY(-2px)`

### Buttons
- Primary: green-dark background, white text, 8px radius
- Secondary: white background, green-dark border + text
- Danger: red background, white text
- Size: min 44px height (accessibility)

### Tables
- Striped rows (every other row `#F9F5EF`)
- Sticky header on scroll
- Responsive: horizontal scroll on mobile

### Forms
- Label above input
- Focus: 2px green-mid border ring
- Error state: red border + error message below
- Input height: 44px

## Spacing System (8px base)
`4 / 8 / 16 / 24 / 32 / 48 / 64px`

## Breakpoints
- Mobile: `< 640px`
- Tablet: `640px – 1024px`
- Desktop: `> 1024px`

## Icons
Use **Feather Icons** (CDN) for consistent line-style icons.
