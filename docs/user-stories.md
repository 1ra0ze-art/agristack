# User Stories — AgriStack

## Farmer / Cooperative Role

### US-01: Register and Login
**As a** farmer/cooperative,  
**I want to** register with my name, cooperative ID, and location,  
**So that** I can access the platform and post my harvest listings.

**Acceptance Criteria:**
- Registration form requires: name, email, password, phone, sector, role
- Login validates credentials and redirects to farmer dashboard
- Incorrect credentials show a descriptive error message

---

### US-02: Post a Harvest Listing
**As a** farmer/cooperative,  
**I want to** create a harvest listing with quantity, price per kg, pickup sector, and available date,  
**So that** buyers can find and book my produce.

**Acceptance Criteria:**
- Form includes: crop type (Irish Potato), quantity (kg), price/kg, pickup sector, harvest date, description
- Listing status defaults to "Pending" until admin approves
- Farmer sees confirmation message after submission

---

### US-03: View My Listings
**As a** farmer,  
**I want to** see all my listings and their statuses (Pending/Approved/Collected),  
**So that** I can track progress of my harvests.

**Acceptance Criteria:**
- Listings table shows: title, quantity, price, status, date posted
- Status badge is color-coded (yellow/green/blue)
- Farmer can edit or delete listings in "Pending" status only

---

### US-04: Edit or Delete a Listing
**As a** farmer,  
**I want to** edit or remove a listing that is still pending,  
**So that** I can correct mistakes before admin approval.

**Acceptance Criteria:**
- Edit button available only when status is "Pending"
- Delete prompts confirmation before removing
- Approved listings are locked from editing

---

## Aggregator / Buyer Role

### US-05: Browse Approved Listings
**As a** buyer,  
**I want to** browse all approved harvest listings with filters by sector and quantity,  
**So that** I can find produce that meets my bulk needs.

**Acceptance Criteria:**
- Only admin-approved listings appear in buyer browse view
- Filter options: sector, min quantity, price range
- Each listing card shows: quantity, price/kg, farmer name, pickup sector, date

---

### US-06: Place a Bulk Booking Request
**As a** buyer,  
**I want to** submit a bulk booking request specifying quantity needed and preferred pickup date,  
**So that** the farmer and admin are notified and can confirm my order.

**Acceptance Criteria:**
- Booking form includes: quantity requested, preferred date, notes
- Live JS estimator shows total cost = qty × price/kg in real time
- Booking saved with status "Pending"
- Buyer sees booking confirmation with summary

---

### US-07: Track My Booking Status
**As a** buyer,  
**I want to** view all my bookings and their current status,  
**So that** I know when my order is approved and ready for collection.

**Acceptance Criteria:**
- Bookings dashboard shows: listing name, qty booked, total value, status
- Status progresses: Pending → Approved → Collected
- Timestamps shown for each status change

---

## Admin Role

### US-08: Approve or Reject Harvest Listings
**As an** admin,  
**I want to** review and approve or reject farmer listings,  
**So that** only verified produce appears to buyers.

**Acceptance Criteria:**
- Admin sees all pending listings with farmer details
- Approve button changes status to "Approved"
- Reject button removes listing and optionally notifies farmer
- Audit log records the action

---

### US-09: Manage Booking Workflow
**As an** admin,  
**I want to** update booking statuses from Pending → Approved → Collected,  
**So that** the platform accurately reflects order progress.

**Acceptance Criteria:**
- Admin can advance any booking to next status
- Status change is timestamped and logged
- Cannot skip statuses (must go Pending → Approved → Collected in order)

---

### US-10: View Dashboard Statistics
**As an** admin,  
**I want to** see today's listings count, total booked value, and top pickup sectors,  
**So that** I can monitor platform activity and make decisions.

**Acceptance Criteria:**
- Dashboard shows: today's new listings, total bookings value (RWF), top 3 sectors by volume
- Stats update on page load
- Charts or stat cards are clearly labeled

---

### US-11: View Audit Log
**As an** admin,  
**I want to** see a log of all platform actions (approvals, rejections, status changes),  
**So that** I can trace who did what and when.

**Acceptance Criteria:**
- Audit log table shows: action, performed by (user), affected record, timestamp
- Sortable by date (newest first)
- Minimum 50 most recent entries shown

---

### US-12: Manage Users
**As an** admin,  
**I want to** view all registered users and their roles,  
**So that** I can deactivate suspicious accounts.

**Acceptance Criteria:**
- User list shows: name, email, role, registration date, status
- Admin can toggle user active/inactive
- Action is logged in audit trail
