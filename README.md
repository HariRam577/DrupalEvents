# Local Events Mini-Site - Drupal 11

A responsive Drupal 11 website for discovering and managing local events with custom API, theming, and CI/CD integration.

## 🚀 Features

- **Custom Content Type**: Event content type with date, location, category, images, and descriptions
- **Taxonomy System**: Event categories (Music, Tech, Sports, Community)
- **Custom API Endpoint**: JSON API for retrieving upcoming events
- **Responsive Theme**: Mobile-first design with breakpoints for desktop, tablet, and mobile
- **Advanced Filtering**: Search and filter events by category and date
- **CI/CD Integration**: GitHub Actions workflow for automated testing

---

## 📋 Requirements

- PHP 8.1 or higher
- MySQL 5.7.8+ or MariaDB 10.3.7+
- Apache/Nginx web server
- Composer 2.x
- Drupal 11.x


---

## 🎨 Design System

### Color Palette

| Color | Hex Code | Usage |
|-------|----------|-------|
| Primary Blue | `#2B6CB0` | Headers, buttons, links |
| Accent Orange | `#F6AD55` | CTAs, highlights |
| Background | `#F7FBFF` | Page background |
| Text Dark | `#1A202C` | Primary text |
| Muted Text | `#4A5568` | Secondary text |

### Responsive Breakpoints

- **Desktop**: ≥1025px (3 cards per row)
- **Tablet**: 641-1024px (2 cards per row)
- **Mobile**: ≤640px (1 card per row)

---

## 🔌 API Documentation

### Upcoming Events Endpoint

**Endpoint:** `/api/events/upcoming`

**Method:** GET

---

## 🧪 Testing

### Running CI Locally

The project includes GitHub Actions CI that validates:
- `composer.json` syntax
- PHP syntax in custom modules and themes
- YAML file validation
- Basic security checks

### Manual Testing

1. **Test API Endpoint:**
   ```bash
   curl http://localhost/api/events/upcoming
   ```

2. **Test Responsive Design:**
   - Open browser DevTools
   - Test at 320px, 768px, and 1920px widths

3. **Test Event Creation:**
   - Navigate to `/node/add/event`
   - Create a test event
   - Verify it appears in `/events` view

---

## 🌐 Key URLs

| Page | URL | Description |
|------|-----|-------------|
| Homepage | `/` | Landing page with hero and featured events |
| Events Listing | `/events` | Filterable view of all upcoming events |
| API Endpoint | `/api/events/upcoming` | JSON endpoint for events data |
| Add Event | `/node/add/event` | Create new event (admin only) |
| Admin Panel | `/admin` | Drupal administration |

---

## 🚀 Deployment

### Production Checklist

- [ ] Set `settings.php` to production mode
- [ ] Disable development modules (Devel, etc.)
- [ ] Enable page caching and aggregation
- [ ] Configure file permissions properly
- [ ] Set up SSL certificate
- [ ] Configure backup strategy
- [ ] Enable error logging
- [ ] Test all forms and API endpoints


---

## 🤝 Contributing

### Branching Strategy

- `main` - Production-ready code
- `develop` - Development branch
- `feature/*` - Feature branches
- `bugfix/*` - Bug fix branches

### Development Workflow

1. Create feature branch: `git checkout -b feature/your-feature`
2. Make changes and commit
3. Push branch: `git push origin feature/your-feature`
4. Create Pull Request
5. Wait for CI checks to pass
6. Merge after review

---

## 📝 Sample Data

The project includes 5 sample events:
1. **Summer Jazz Festival 2025** (Music)
2. **Tech Innovation Summit** (Tech)
3. **City Marathon 2025** (Sports)
4. **Community Food Drive** (Community)
5. **Rock Concert: Electric Nights** (Music)

---

## 🐛 Troubleshooting

### Common Issues

**Issue**: API returns empty results
- Check that events have future dates
- Verify events are published
- Clear cache

---

## 📄 License

This project is for educational/assessment purposes.

---


- Drupal Community
- Color palette inspired by modern design systems
- Built with Drupal 11

---

## 📞 Support

For issues and questions:
1. Check the troubleshooting section
2. Review Drupal documentation
3. Open an issue on GitHub

---

**Last Updated:** December 29, 2025
