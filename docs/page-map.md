# Page Map — AgriStack

## Route Structure

```
/                           → Redirect to /login
/login                      → Auth: Login page (all roles)
/register                   → Auth: Register page (Farmer / Buyer)
/logout                     → Auth: Destroy session, redirect /login

── FARMER ROUTES ──────────────────────────────────────
/farmer/dashboard           → Stats: my listings count, total booked, pending
/farmer/listings            → View all my listings (with status)
/farmer/listings/create     → Create new harvest listing
/farmer/listings/edit/{id}  → Edit listing (Pending only)
/farmer/listings/delete/{id}→ Delete listing (Pending only)
/farmer/bookings            → View bookings made against my listings

── BUYER ROUTES ────────────────────────────────────────
/buyer/dashboard            → Stats: my bookings, total value, status breakdown
/buyer/listings             → Browse all approved listings (with filters)
/buyer/book/{listing_id}    → Place bulk booking request (with live estimator)
/buyer/bookings             → My bookings + status tracking

── ADMIN ROUTES ────────────────────────────────────────
/admin/dashboard            → Stats: today's listings, total booked value, top sectors
/admin/listings             → All listings — approve/reject
/admin/listings/{id}        → Listing detail view
/admin/bookings             → All bookings — advance workflow status
/admin/users                → All users — view/deactivate
/admin/audit-log            → Full audit trail table
```

## Navigation by Role

### Farmer Nav
- Dashboard | My Listings | + New Listing | Bookings on My Listings | Logout

### Buyer Nav
- Dashboard | Browse Listings | My Bookings | Logout

### Admin Nav
- Dashboard | Listings | Bookings | Users | Audit Log | Logout

## Page Hierarchy Diagram

```
AgriStack
├── Public
│   ├── Login
│   └── Register
├── Farmer (auth: farmer)
│   ├── Dashboard
│   ├── Listings (list, create, edit, delete)
│   └── Bookings (read-only view)
├── Buyer (auth: buyer)
│   ├── Dashboard
│   ├── Browse Listings
│   ├── Book Listing
│   └── My Bookings
└── Admin (auth: admin)
    ├── Dashboard
    ├── Manage Listings
    ├── Manage Bookings
    ├── Manage Users
    └── Audit Log
```
