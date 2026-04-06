# VK Hotel - API Documentation

## Overview
This API provides endpoints for managing hotel bookings, rooms, and reviews. The API follows RESTful conventions and returns JSON responses.

## Base URL
- **Development**: `http://localhost:8000/api`
- **Production**: `https://your-app.onrender.com/api`

---

## Authentication
Most endpoints require authentication using Laravel Sanctum tokens.

### Bearer Token
Include your token in the request header:
```
Authorization: Bearer {token}
```

### Login to Get Token
```
POST /login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password"
}
```

---

## API Endpoints

### 🏨 Rooms (Public)

#### Get All Available Rooms
```
GET /api/public/rooms
Parameters:
  - type: string (single, double, suite, deluxe)
  - min_price: number
  - max_price: number
  - capacity: integer
  - check_in: date (YYYY-MM-DD)
  - check_out: date (YYYY-MM-DD)
  - per_page: integer (default: 15)

Response: 200 OK
{
  "data": [...],
  "links": {...},
  "meta": {...}
}
```

#### Get Single Room Details
```
GET /api/public/rooms/{id}

Response: 200 OK
{
  "data": {
    "id": 1,
    "room_number": "101",
    "type": "double",
    "price": 99.99,
    "capacity": 2,
    "description": "...",
    "amenities": [...],
    "reviews": [...]
  },
  "average_rating": 4.5,
  "total_reviews": 12
}
```

#### Search Rooms (Advanced)
```
GET /api/public/rooms/search/advanced
Parameters:
  - check_in: date (required)
  - check_out: date (required)
  - guests: integer (required)
  - type: string (optional)
  - min_price: number (optional)
  - max_price: number (optional)

Response: 200 OK
{
  "count": 5,
  "data": [...]
}
```

#### Get Room Availability Calendar
```
GET /api/public/rooms/{id}/availability
Parameters:
  - start_date: date (required)
  - end_date: date (required)

Response: 200 OK
{
  "room_id": 1,
  "start_date": "2026-04-01",
  "end_date": "2026-04-30",
  "bookings": [...]
}
```

---

### 📅 Bookings (Protected)

#### Get My Bookings
```
GET /api/bookings
Headers: Authorization: Bearer {token}

Response: 200 OK
{
  "data": [...],
  "links": {...},
  "meta": {...}
}
```

#### Create Booking
```
POST /api/bookings
Headers: Authorization: Bearer {token}
Content-Type: application/json

{
  "room_id": 1,
  "check_in_date": "2026-04-15",
  "check_out_date": "2026-04-20",
  "guests": 2,
  "special_requests": "High floor, near elevator"
}

Response: 201 Created
{
  "message": "Booking created successfully",
  "data": {...}
}
```

#### Get Booking Details
```
GET /api/bookings/{id}
Headers: Authorization: Bearer {token}

Response: 200 OK
{
  "data": {...}
}
```

#### Cancel Booking
```
POST /api/bookings/{id}/cancel
Headers: Authorization: Bearer {token}

Response: 200 OK
{
  "message": "Booking cancelled successfully",
  "data": {...}
}
```

#### Get Booking Statistics (Admin Only)
```
GET /api/statistics/bookings
Headers: Authorization: Bearer {admin_token}

Response: 200 OK
{
  "data": {
    "total_bookings": 150,
    "pending_bookings": 10,
    "confirmed_bookings": 100,
    "completed_bookings": 35,
    "cancelled_bookings": 5,
    "total_revenue": 15000.00,
    "average_booking_value": 100.00,
    "occupancy_rate": "85%"
  }
}
```

---

### ⭐ Reviews (Public & Protected)

#### Get Room Reviews
```
GET /api/public/rooms/{id}/reviews
Parameters:
  - per_page: integer (default: 10)

Response: 200 OK
{
  "data": [...],
  "links": {...},
  "meta": {...}
}
```

#### Get Review Statistics
```
GET /api/public/rooms/{id}/reviews/statistics

Response: 200 OK
{
  "data": {
    "total_reviews": 25,
    "average_rating": 4.6,
    "rating_distribution": {
      "5": 15,
      "4": 8,
      "3": 2,
      "2": 0,
      "1": 0
    }
  }
}
```

#### Create Review (Protected)
```
POST /api/rooms/{id}/reviews
Headers: Authorization: Bearer {token}
Content-Type: application/json

{
  "booking_id": 5,
  "rating": 5,
  "title": "Amazing stay!",
  "comment": "The room was spacious and clean. Great service!"
}

Response: 201 Created
{
  "message": "Review submitted successfully",
  "data": {...}
}
```

---

## Error Responses

### 400 Bad Request
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

### 401 Unauthorized
```json
{
  "message": "Unauthorized"
}
```

### 403 Forbidden
```json
{
  "message": "Forbidden"
}
```

### 404 Not Found
```json
{
  "message": "Not found"
}
```

### 409 Conflict
```json
{
  "message": "Room is not available for the selected dates"
}
```

### 422 Unprocessable Entity
```json
{
  "message": "Validation failed",
  "errors": {
    "field": ["Error message"]
  }
}
```

### 500 Internal Server Error
```json
{
  "message": "Internal server error"
}
```

---

## Rate Limiting
API requests are rate-limited to prevent abuse:
- **Limit**: 60 requests per minute
- **Header**: `X-RateLimit-Remaining`

---

## Best Practices

1. **Always validate input** before sending to API
2. **Use pagination** for large dataset requests
3. **Handle errors gracefully** with proper error handling
4. **Cache responses** when appropriate
5. **Use HTTPS** in production
6. **Keep tokens secure** and never expose in frontend code
7. **Implement request timeouts** (5-10 seconds)

---

## Examples

### Using cURL
```bash
# Get available rooms
curl -X GET "http://localhost:8000/api/public/rooms?type=double&min_price=50&max_price=150" \
  -H "Accept: application/json"

# Create booking
curl -X POST "http://localhost:8000/api/bookings" \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "room_id": 1,
    "check_in_date": "2026-04-15",
    "check_out_date": "2026-04-20",
    "guests": 2
  }'
```

### Using JavaScript/Axios
```javascript
// Get available rooms
const response = await axios.get('/api/public/rooms', {
  params: {
    type: 'double',
    min_price: 50,
    max_price: 150
  }
});

// Create booking
const booking = await axios.post('/api/bookings', {
  room_id: 1,
  check_in_date: '2026-04-15',
  check_out_date: '2026-04-20',
  guests: 2
}, {
  headers: {
    'Authorization': `Bearer ${token}`
  }
});
```

---

## Support
For issues or questions, contact: support@vkhotel.com
