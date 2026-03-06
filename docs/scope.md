# Scope & Non-Functional Requirements — AgriStack

## In Scope

### Functional Scope
| Feature | Description |
|---|---|
| Authentication | Login/register for 3 roles (Farmer, Buyer, Admin) |
| Harvest Listings | CRUD operations for cooperative listings |
| Bulk Booking | Buyer places booking requests against listings |
| Booking Workflow | Status: Pending → Approved → Collected |
| Admin Approval | Admin reviews and approves/rejects listings |
| Dashboard Stats | Today's listings, total booked value, top sectors |
| Live Price Estimator | JS widget: qty × price/kg = total |
| Audit Log | Action, user, timestamp table |
| User Management | Admin can view/deactivate users |

### Technical Scope
- PHP (MVC architecture, no frameworks)
- MySQL with MySQLi prepared statements
- Responsive HTML/CSS (mobile + desktop)
- Vanilla JavaScript for interactivity
- Hosted on InfinityFree or 000webhost

## Out of Scope (v1.0)
- Mobile native app
- Payment gateway / online payments
- SMS/email notifications
- GPS/map integration for pickup
- Real-time chat between buyer and farmer
- Multi-language support (Kinyarwanda)
- Inventory management / stock tracking
- Review/rating system

## Non-Functional Requirements

### Performance
- Page load time < 3 seconds on standard broadband
- Dashboard stats queries optimized with indexes
- Pagination on listings and booking tables (25 per page)

### Security
- All inputs sanitized and validated server-side
- Prepared statements used for all DB writes
- Passwords hashed using `password_hash()` (bcrypt)
- Session-based authentication with role checks on every page
- CSRF protection on forms

### Usability
- Mobile-first responsive design
- WCAG 2.1 AA accessibility compliance
- Clear error messages and success confirmations
- Consistent navigation across all roles

### Reliability
- Form validation (client + server side)
- Graceful error handling (no raw PHP errors shown to users)
- Database transactions for multi-step operations

### Maintainability
- MVC separation: no SQL in views
- Reusable partials: header, footer, nav
- Consistent naming conventions (snake_case DB, camelCase PHP)
- Inline code comments on complex logic

### Scalability
- DB schema designed to support future crops beyond Irish Potato
- Role system extensible for future roles (e.g., logistics, inspector)
