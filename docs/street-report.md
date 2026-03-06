# Street Report — AgriStack Irish Potato Marketplace

**Assignment:** Web Development 2 — Group Project
**Date:** March 2025
**Location:** Musanze District, Northern Province, Rwanda

---

## 1. User Quote

> "Turagurisha ibirayi byacu ku giciro cyoroheje kuko nta yandi mahitamo dufite. Abantu baza ino bakabigura kugiciro kiri hasi, bakabitwara i Kigali bakabigurisha inshuro eshatu y'igiciro babitwariye."
>
> *(Translation: "We sell our potatoes at a very low price because we have no other options. People come here, buy them cheaply, take them to Kigali and sell at triple the price we harvested them for.")*
>
> — **Cooperative Twitezimbere chairperson, Kinigi Sector, Musanze District** (interviewed February 2025)

---

## 2. The Exact Problem Being Solved

Farmers and cooperatives in Musanze District grow Irish potatoes in large quantities, particularly in high-altitude sectors like Kinigi, Shingiro, and Cyuve. However, they consistently earn 30–50% below fair market value due to the following structural problems:

| Problem | Impact |
|---|---|
| No direct access to bulk buyers (supermarkets, exporters, institutions) | Farmers forced to sell only to local middlemen |
| Middlemen buy at farm-gate prices and resell at 2–3x in urban markets | Farmers capture almost none of the final market value |
| No platform to post available stock and attract verified buyers | Harvests go unsold or are offloaded at distress prices |
| Informal agreements with no tracking or accountability | Disputes over quantities, payments, and pickup dates are common |
| Cooperatives cannot plan supply chains | Buyers cannot guarantee supply; farmers cannot guarantee demand |

**Core problem statement:** There is no trusted digital channel through which Musanze potato farmers and cooperatives can list their harvest and connect directly with bulk buyers — creating a price information gap that middlemen exploit at the farmer's expense.

---

## 3. Chosen Scenario

**Scenario A — AgriStack: Irish Potato Marketplace**

We selected this scenario because:

- Irish potatoes are the dominant cash crop in Musanze/Kinigi, making it immediately relevant to the local farming community
- The cooperative structure already exists in the area — a digital platform aligns with how farmers already organize
- The problem is observable and verifiable: we spoke to cooperative members at INES Ruhengeri who confirmed price manipulation is a daily reality
- The solution (listing + booking workflow) maps directly to a real transaction flow that farmers and buyers can adopt without significant behavior change

**Context at INES Ruhengeri:** Several students in our group come from farming families in Musanze. During semester break, group members observed cooperative meetings where potato harvest pricing was debated and middlemen were a recurring frustration. This assignment gave us an opportunity to build a real solution for a problem we have personally witnessed.

---

## 4. Scope for This Assignment

### In Scope (v1.0 — this assignment)

| Feature | Description |
|---|---|
| Three-role authentication | Farmer/Coop, Buyer/Aggregator, Admin |
| Harvest listing CRUD | Farmers post, edit, and delete listings |
| Admin approval workflow | Listings go Pending → Approved/Rejected before buyers see them |
| Bulk booking system | Buyers browse approved listings and place bulk booking requests |
| Booking status tracking | Pending → Approved → Collected |
| Dashboard statistics | Today's listings, total booked value, top pickup sectors |
| Live price estimator | JS widget: quantity × price/kg = estimated total (real-time) |
| Admin audit log | Records all approvals, rejections, status changes with timestamp |
| User management | Admin can activate/deactivate accounts |
| Responsive UI | Works on mobile and desktop |

### Out of Scope (future versions)

- Online payment / mobile money integration (MTN MoMo, Airtel)
- SMS/email notifications to farmers on booking
- GPS map of pickup locations
- Multi-language support (Kinyarwanda interface)
- Native mobile app
- Logistics / truck booking integration
- Price trend analytics / market reports

### Technical Scope

- **Backend:** PHP 8+ (MVC, no framework)
- **Database:** MySQL with MySQLi prepared statements
- **Frontend:** HTML5, CSS3, Vanilla JavaScript
- **Hosting:** InfinityFree / 000webhost (PHP + MySQL supported)
- **Version control:** GitHub (min. 25 commits, all members contributing)

---

## 5. Why This Matters

Rwanda's Vision 2050 and the agricultural transformation agenda both prioritize connecting smallholder farmers to markets. AgriStack is a small but concrete demonstration of how a simple web application — built by students — can address a real economic injustice experienced by farming communities just kilometers from our campus.

The farmers of Musanze don't need pity. They need infrastructure. This is ours.

---

*Prepared by: Group 4*
*Course: Web Development 2 — INES Ruhengeri*
