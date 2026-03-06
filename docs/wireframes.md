# Wireframes — AgriStack

Wireframes are described below in ASCII layout form for both mobile and desktop views.
Visual wireframe files (PNG) would be in this directory in a full design handoff.

---

## 1. Login Page

### Mobile (375px)
```
┌─────────────────────┐
│  🌾 AgriStack       │
│  ─────────────────  │
│                     │
│  [Email          ]  │
│  [Password       ]  │
│                     │
│  [ Login Button  ]  │
│                     │
│  Don't have acc?    │
│  Register here →    │
└─────────────────────┘
```

### Desktop (1280px)
```
┌─────────────────────────────────────────────────────┐
│        LEFT: Hero image (farmer in field)           │
│        + tagline: "Fair prices. Direct access."     │
│                          │                          │
│                          │  RIGHT: Login Card        │
│                          │  ┌──────────────────┐    │
│                          │  │ 🌾 AgriStack     │    │
│                          │  │ Email [        ] │    │
│                          │  │ Pass  [        ] │    │
│                          │  │ [  Login  ]      │    │
│                          │  │ Register →       │    │
│                          │  └──────────────────┘    │
└─────────────────────────────────────────────────────┘
```

---

## 2. Farmer Dashboard

### Mobile
```
┌─────────────────────┐
│ ≡ AgriStack  [👤]   │
├─────────────────────┤
│ Welcome, Jean!      │
│                     │
│ ┌───┐ ┌───┐ ┌───┐  │
│ │ 3 │ │ 5 │ │ 2 │  │
│ │lst│ │bkd│ │pnd│  │
│ └───┘ └───┘ └───┘  │
│                     │
│ My Recent Listings  │
│ ┌─────────────────┐ │
│ │ Irish Potato    │ │
│ │ 500kg • 250/kg  │ │
│ │ [Pending]       │ │
│ └─────────────────┘ │
│ ┌─────────────────┐ │
│ │ Irish Potato    │ │
│ │ 300kg • 200/kg  │ │
│ │ [Approved] ✓   │ │
│ └─────────────────┘ │
│                     │
│ [+ New Listing]     │
└─────────────────────┘
```

### Desktop
```
┌──────┬──────────────────────────────────────────────┐
│      │ Welcome back, Jean Damascène                 │
│ NAV  │ ─────────────────────────────────────────    │
│      │  ┌──────┐  ┌──────┐  ┌──────┐  ┌──────┐    │
│ Dash │  │  3   │  │  8   │  │ 450k │  │  1   │    │
│ List │  │Lstngs│  │Bookgs│  │ Val. │  │Pendng│    │
│ +New │  └──────┘  └──────┘  └──────┘  └──────┘    │
│ Bkgs │                                             │
│ Out  │  My Listings                    [+ New]     │
│      │  ┌────────────────────────────────────────┐ │
│      │  │ # │ Crop  │ Qty │ Price│ Status│ Act  │ │
│      │  │ 1 │ I.Pot │500kg│250/kg│Pending│Edit  │ │
│      │  │ 2 │ I.Pot │300kg│200/kg│Apprvd │ —    │ │
│      │  └────────────────────────────────────────┘ │
└──────┴──────────────────────────────────────────────┘
```

---

## 3. Buyer: Browse Listings + Booking Form

### Desktop
```
┌──────┬──────────────────────────────────────────────┐
│      │ Browse Available Listings                    │
│ NAV  │  Filters: [Sector ▼] [Min Qty] [Max Price]  │
│      │  ─────────────────────────────────────────  │
│ Dash │  ┌──────────┐ ┌──────────┐ ┌──────────┐    │
│ Brws │  │Irish Pot │ │Irish Pot │ │Irish Pot │    │
│ Bkgs │  │500kg     │ │300kg     │ │800kg     │    │
│ Out  │  │250 RWF/kg│ │200 RWF/kg│ │180 RWF/kg│    │
│      │  │Musanze   │ │Kinigi    │ │Shingiro  │    │
│      │  │[Book Now]│ │[Book Now]│ │[Book Now]│    │
│      │  └──────────┘ └──────────┘ └──────────┘    │
└──────┴──────────────────────────────────────────────┘

Booking Modal/Page:
┌─────────────────────────────────────┐
│ Book: Irish Potato — 500kg @ 250/kg │
│ ─────────────────────────────────── │
│ Quantity (kg): [          ]         │
│ Pickup Date:   [          ]         │
│ Notes:         [          ]         │
│                                     │
│ 💰 Estimated Total: 0 RWF          │
│    (updates live as you type)       │
│                                     │
│ [Cancel]          [Submit Booking]  │
└─────────────────────────────────────┘
```

---

## 4. Admin Dashboard

### Desktop
```
┌──────┬──────────────────────────────────────────────┐
│      │ Admin Dashboard                              │
│ NAV  │  ┌────────┐ ┌────────┐ ┌────────┐ ┌──────┐ │
│      │  │Today's │ │Total   │ │ Top    │ │Users │ │
│ Dash │  │Listings│ │Booked  │ │Sectors │ │Active│ │
│ List │  │   7    │ │2.4M RWF│ │Musanze │ │  42  │ │
│ Bkgs │  └────────┘ └────────┘ └────────┘ └──────┘ │
│ Usrs │                                             │
│ Audit│  Pending Listings (needs approval)          │
│ Out  │  ┌──────────────────────────────────────┐   │
│      │  │ Farmer  │ Qty  │ Price │ [✓] [✗]    │   │
│      │  │ Jean D  │ 500kg│ 250   │ [✓] [✗]    │   │
│      │  └──────────────────────────────────────┘   │
│      │                                             │
│      │  Audit Log (recent)                         │
│      │  ┌──────────────────────────────────────┐   │
│      │  │ Action      │ User   │ Timestamp     │   │
│      │  │ Approved #3 │ Admin1 │ 2024-11-05 9am│   │
│      │  └──────────────────────────────────────┘   │
└──────┴──────────────────────────────────────────────┘
```
