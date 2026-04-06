# VK Hotel - Deployment Guide for Render

## Quick Start Deployment (5 minutes)

### Prerequisites
- GitHub account with your repository
- Render.com account (free)
- PostgreSQL database on Render

### Step 1: Prepare Your Repository

```bash
# Ensure all files are committed
git add .
git commit -m "Add production configuration for Render deployment"
git push origin main
```

### Step 2: Create PostgreSQL Database on Render

1. Go to [Render Dashboard](https://dashboard.render.com)
2. Click "New +" → "PostgreSQL"
3. Configure:
   - **Name**: vk-hotel-db
   - **Database**: vk_hotel
   - **User**: postgres
   - **Region**: Choose closest to your users
4. Create and note the connection string

### Step 3: Create Web Service on Render

1. Click "New +" → "Web Service"
2. Select your GitHub repository
3. Configure:
   - **Name**: vk-hotel
   - **Environment**: PHP
   - **Build Command**: `./scripts/build.sh`
   - **Start Command**: `./scripts/start.sh`
   - **Plan**: Free (or upgrade as needed)

### Step 4: Set Environment Variables

In the "Environment" section, add these variables:

```env
APP_NAME=VK Hotel
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APP_KEY_HERE  # Copy from local .env
APP_URL=https://your-app.onrender.com

DB_CONNECTION=pgsql
DB_HOST=your-db-instance.onrender.com
DB_PORT=5432
DB_DATABASE=vk_hotel
DB_USERNAME=postgres
DB_PASSWORD=your_db_password

LOG_CHANNEL=stderr
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS=noreply@vkhotel.com
```

### Step 5: Deploy and Verify

1. Render will automatically deploy after you push to GitHub
2. Monitor the deployment in the Logs section
3. Once deployed, visit your app URL
4. Run database migrations:

```bash
# Via Render Shell (in the Web Service details):
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder
```

---

## Detailed Environment Variables

### Core Configuration
```env
APP_NAME=VK Hotel
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:xxx
APP_URL=https://your-app.onrender.com
```

### Database
```env
DB_CONNECTION=pgsql
DB_HOST=your-db-instance.onrender.com
DB_PORT=5432
DB_DATABASE=vk_hotel
DB_USERNAME=postgres
DB_PASSWORD=your_secure_password
```

### Mail Service (Mailtrap)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@vkhotel.com
MAIL_FROM_NAME="VK Hotel"
```

### Payment Gateway (Optional - Stripe)
```env
STRIPE_PUBLIC_KEY=pk_live_xxx
STRIPE_SECRET_KEY=sk_live_xxx
STRIPE_WEBHOOK_SECRET=whsec_xxx
```

### Caching & Sessions
```env
CACHE_DRIVER=array
SESSION_DRIVER=cookie
BROADCAST_DRIVER=log
QUEUE_CONNECTION=sync
```

---

## Troubleshooting

### Deployment Fails
**Check logs:**
- View real-time logs in Render Dashboard
- Look for syntax or configuration errors
- Ensure `.env.example` and migrations are committed

**Common issues:**
```bash
# Missing migrations
php artisan migrate --force

# Missing composer dependencies
composer install --no-dev

# Node modules issue
npm install --production
```

### Database Connection Error
```bash
# Test connection
php artisan tinker
DB::connection()->getPDO();
```

**Solution:**
- Verify DATABASE_URL in environment variables
- Check database credentials in `.env`
- Ensure database instance is available on Render

### Assets Not Loading (404 errors)
```bash
# Rebuild assets
npm run build
php artisan optimize
```

### White Screen of Death (500 error)
```bash
# Check logs
tail storage/logs/laravel.log

# Clear caches
php artisan cache:clear
php artisan config:clear
```

---

## Performance Optimization

### Enable Caching
```env
CACHE_DRIVER=redis
# Or use array caching on free tier
CACHE_DRIVER=array
```

### Route Caching
The start script automatically caches routes:
```bash
php artisan route:cache
php artisan optimize:clear
```

### Database Optimization
- Add indexes to frequently queried columns ✓ (Already done)
- Use pagination (included in API responses)
- Enable query caching for analytics

---

## CI/CD with Render

### Auto-Deploy on Push
1. Your app automatically redeploys when you push to your GitHub repository
2. Render builds using `scripts/build.sh`
3. Starts using `scripts/start.sh`

### Manual Deployment
1. Go to Web Service → "Manual Deploy"
2. Select branch and deploy

### Rollback
If deployment fails, Render keeps your previous build available. Click "Rollback" to revert.

---

## Monitoring & Maintenance

### Check Application Health
```bash
# Via Render Shell
php artisan tinker

# Check database
DB::table('bookings')->count()

# Check cache
Cache::get('key')
```

### View Logs
- **Build Logs**: Deploy history
- **Logs**: Real-time application logs
- **Metrics**: CPU, Memory, request count

### Scheduled Tasks
For background jobs, use an external service like:
- EasyCron (free tier available)
- Custom monitoring solution

---

## Scaling Your App

### From Free to Paid
1. Click "Instance Type" in service settings
2. Choose "Pro" or "Premium"
3. Automatic restart with new resources

### Database Upgrade
1. Click "PostgreSQL" instance
2. Upgrade plan for more storage/performance
3. Minimal downtime during upgrade

---

## Team Collaboration

### Multiple Environments
1. Create separate Render services for staging
2. Use different GitHub branches
3. Same config structure, different env variables

### Secrets Management
- Store sensitive data in Render environment variables
- Never commit `.env` file
- Use `.env.example` as template

---

## Security Checklist

- [ ] Copy APP_KEY from local `.env`
- [ ] Change default admin password
- [ ] Set strong database password
- [ ] Configure HTTPS (automatic on Render)
- [ ] Set `APP_DEBUG=false` in production
- [ ] Configure mail service credentials securely
- [ ] Set up payment webhook secrets
- [ ] Enable database backups
- [ ] Configure CORS properly
- [ ] Limit API rate limiting

---

## Support & Resources

- 📖 [Render Documentation](https://render.com/docs)
- 🐛 [Report Issues](https://github.com/your-repo/issues)
- 💬 [Community Chat](http://discord.gg/your-server)
- 📧 Email: support@vkhotel.com

---

**Happy Deploying!** 🚀
