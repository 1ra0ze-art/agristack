# Testing Documentation — AgriStack

## Testing Approach
Manual functional testing was performed across all user roles using the live staging environment. Test cases cover authentication, CRUD operations, workflow states, validation, and access control.

---

## Test Cases & Results

| # | Test Case | Role | Steps | Expected Result | Actual Result | Pass/Fail |
|---|---|---|---|---|---|---|
| TC-01 | Valid Login - Farmer | Farmer | Enter farmer@agristack.rw + correct password, click Sign In | Redirect to /farmer/dashboard | Redirected to farmer dashboard | ✅ PASS |
| TC-02 | Valid Login - Buyer | Buyer | Enter buyer@agristack.rw + correct password | Redirect to /buyer/dashboard | Redirected to buyer dashboard | ✅ PASS |
| TC-03 | Valid Login - Admin | Admin | Enter admin@agristack.rw + correct password | Redirect to /admin/dashboard | Redirected to admin dashboard | ✅ PASS |
| TC-04 | Invalid Login | Any | Enter wrong password | Error message displayed, stay on login | "Invalid email or password." shown | ✅ PASS |
| TC-05 | Registration - New Farmer | Public | Fill registration form as farmer, submit | Account created, redirect to login with success message | Account created, redirected correctly | ✅ PASS |
| TC-06 | Registration - Duplicate Email | Public | Register with an already-used email | Error: "Email already registered." | Error displayed, form not submitted | ✅ PASS |
| TC-07 | Create Harvest Listing | Farmer | Fill listing form with qty=500, price=250, sector=Kinigi, submit | Listing created with status "Pending", success message | Listing saved, pending status shown | ✅ PASS |
| TC-08 | Create Listing - Missing Fields | Farmer | Submit listing form with empty qty | Validation error, form not submitted | PHP validation triggers, error shown | ✅ PASS |
| TC-09 | Edit Pending Listing | Farmer | Edit a pending listing, change price to 300 | Updated successfully, same pending status | Update saved, reflected in table | ✅ PASS |
| TC-10 | Edit Approved Listing | Farmer | Attempt to edit an approved listing | Edit button not shown, redirect on direct URL | Button hidden, controller blocks edit | ✅ PASS |
| TC-11 | Delete Pending Listing | Farmer | Click delete on pending listing, confirm | Listing removed, success flash | Listing deleted from DB and table | ✅ PASS |
| TC-12 | Admin Approve Listing | Admin | Click Approve on a pending listing | Status changes to Approved, audit log entry created | Status updated, log entry visible | ✅ PASS |
| TC-13 | Admin Reject Listing | Admin | Click Reject on a pending listing | Status changes to Rejected, audit log entry created | Status updated, log entry visible | ✅ PASS |
| TC-14 | Buyer Browse Listings | Buyer | Navigate to /buyer/listings | Only approved listings shown | Only approved listings displayed | ✅ PASS |
| TC-15 | Buyer Filter by Sector | Buyer | Select "Kinigi" in sector filter, submit | Only Kinigi listings shown | Filtered results correct | ✅ PASS |
| TC-16 | Bulk Booking - Live Estimator | Buyer | Enter qty=200 in booking form, price is 250/kg | Estimator shows 50,000 RWF dynamically | JS updates to "50,000 RWF" instantly | ✅ PASS |
| TC-17 | Place Bulk Booking | Buyer | Complete booking form for approved listing | Booking saved with status "Pending", success message | Booking created, visible in bookings table | ✅ PASS |
| TC-18 | Booking Over Available Qty | Buyer | Try to book 1000kg from a 500kg listing | Error: quantity exceeds available | Validation error shown | ✅ PASS |
| TC-19 | Admin Advance Booking - Pending→Approved | Admin | Click "Advance" on a Pending booking | Status changes to Approved | Status updated to Approved | ✅ PASS |
| TC-20 | Admin Advance Booking - Approved→Collected | Admin | Click "Advance" on an Approved booking | Status changes to Collected | Status updated to Collected | ✅ PASS |
| TC-21 | Admin Audit Log | Admin | Visit /admin/audit-log | All actions logged with user, action, timestamp | Log table shows all entries correctly | ✅ PASS |
| TC-22 | Admin Dashboard Stats | Admin | Visit /admin/dashboard | Today's listings count, total booked value, top sectors displayed | All stats correct and visible | ✅ PASS |
| TC-23 | Role-Based Access Control | Buyer | Attempt to access /farmer/dashboard via URL | Redirect to login (access denied) | Redirected to /login | ✅ PASS |
| TC-24 | Admin Deactivate User | Admin | Toggle active status for a farmer user | User set to inactive, login blocked | Status toggled, logged in audit | ✅ PASS |
| TC-25 | Deactivated User Login | Farmer | Login with a deactivated account | Error: "Your account has been deactivated." | Error message shown, login blocked | ✅ PASS |

---

## Test Summary

| Category | Total Tests | Passed | Failed |
|---|---|---|---|
| Authentication | 4 | 4 | 0 |
| Registration | 2 | 2 | 0 |
| Listings CRUD | 5 | 5 | 0 |
| Admin Approval | 2 | 2 | 0 |
| Buyer Browse & Book | 4 | 4 | 0 |
| Booking Workflow | 2 | 2 | 0 |
| Admin Dashboard & Audit | 2 | 2 | 0 |
| Access Control | 2 | 2 | 0 |
| User Management | 2 | 2 | 0 |
| **TOTAL** | **25** | **25** | **0** |

**Pass Rate: 100%** ✅

---

## Test Environment
- PHP 8.2 on localhost (XAMPP/WAMP)
- MySQL 8.0
- Browsers tested: Chrome 120, Firefox 121
- Devices tested: Desktop (1440px), tablet (768px), mobile (375px)

## Known Limitations
- Email notification on approval not yet implemented (out of scope for v1.0)
- No automated unit tests (PHPUnit integration planned for v2.0)
