<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/custom/events_theme/templates/page--front.html.twig */
class __TwigTemplate_04939420f9cc75a5430dd2b87bbc89aa extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "
<header class=\"site-header\">
  <div class=\"container\">
    <div class=\"site-logo\">
      <a href=\"";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("<front>"));
        yield "\">Local Events</a>
    </div>
    ";
        // line 13
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 14
            yield "      <nav class=\"main-nav\">
        ";
            // line 15
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 15), "html", null, true);
            yield "
      </nav>
    ";
        }
        // line 18
        yield "  </div>
</header>

<section class=\"hero-section\">
  <div class=\"container\">
    <h1>Discover Amazing Events Near You</h1>
    <p>Connect with your community through music, tech, sports, and more</p>
    <a href=\"http://localhost/drupal/install-dir/web/events\" class=\"cta-button\">Explore Events</a>
  </div>
</section>

<main class=\"main-content\">
  <div class=\"container\">
    <section class=\"filter-bar\">
      <form class=\"filter-form\" id=\"events-filter-form\">
        <div class=\"filter-group\">
          <label for=\"category-filter\">Category</label>
          <select name=\"category\" id=\"category-filter\">
            <option value=\"\">All Categories</option>
            <option value=\"3\">Sports</option>
            <option value=\"4\">Community</option>
          </select>
        </div>
        <div class=\"filter-group\">
          <label for=\"date-filter\">Date</label>
          <input type=\"date\" name=\"date\" id=\"date-filter\" value=\"2025-12-29\">
        </div>
        <button type=\"submit\" class=\"filter-submit\">Search Events</button>
        <button type=\"button\" id=\"clear-filters\" class=\"clear-button\">Clear</button>
      </form>
    </section>

    <section class=\"featured-events\">
      <h2 class=\"section-title\">Featured Upcoming Events</h2>
      <div class=\"events-grid\" id=\"featured-events-container\">
        <div class=\"loading\">Loading featured events...</div>
      </div>
      <div class=\"text-center mt-4\">
        <a href=\"http://localhost/drupal/install-dir/web/events\" class=\"cta-button\">View All Events</a>
      </div>
    </section>
  </div>
</main>

<footer class=\"site-footer\">
  <div class=\"container\">
    <p>&copy; ";
        // line 64
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " Local Events. All rights reserved.</p>
  </div>
</footer>

<script>
(function() {
  'use strict';
  
  const container = document.getElementById('featured-events-container');
  const filterForm = document.getElementById('events-filter-form');
  let currentFilters = {};
  const API_BASE = 'http://localhost/drupal/install-dir/web';
  
  loadFeaturedEvents();
  
  filterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    updateFilters();
    loadFeaturedEvents();
  });
  
  document.getElementById('clear-filters').addEventListener('click', function() {
    document.getElementById('category-filter').value = '';
    document.getElementById('date-filter').value = '';
    currentFilters = {};
    loadFeaturedEvents();
  });
  
  function updateFilters() {
    const formData = new FormData(filterForm);
    currentFilters = Object.fromEntries(formData);
    Object.keys(currentFilters).forEach(key => {
      if (!currentFilters[key]) delete currentFilters[key];
    });
  }
  
  function loadFeaturedEvents() {
    const params = new URLSearchParams(currentFilters);
    const url = `\${API_BASE}/api/events/upcoming\${params.toString() ? '?' + params.toString() : ''}`;
    
    console.log('Fetching:', url); // DEBUG
    
    container.innerHTML = '<div class=\"loading\">Loading events...</div>';
    
    fetch(url)
      .then(response => {
        if (!response.ok) throw new Error(`HTTP \${response.status}`);
        return response.json();
      })
      .then(data => renderEvents(data))
      .catch(error => {
        console.error('API Error:', error);
        container.innerHTML = `<div class=\"error\">Error: \${error.message}</div>`;
      });
  }
  
  function renderEvents(data) {
    container.innerHTML = '';
    if (data.status === 'success' && data.events?.length > 0) {
      data.events.slice(0, 3).forEach(event => {
        container.appendChild(createEventCard(event));
      });
    } else {
      container.innerHTML = '<p class=\"no-events\">No events found.</p>';
    }
  }
  
  function createEventCard(event) {
    const date = new Date(event.date);
    const formattedDate = date.toLocaleDateString('en-US', { 
      month: 'short', day: 'numeric', year: 'numeric'
    });
    
    const imageUrl = event.image_url || '/themes/custom/events_theme/images/placeholder.jpg';
    const categoryName = event.category?.name || 'Event';
    const location = event.location || 'Location TBD';
    const summary = event.summary || (event.body ? event.body.substring(0, 100) + '...' : 'No description');
    
    const article = document.createElement('article');
    article.className = 'event-card';
    article.tabIndex = 0;
    article.innerHTML = `
      <div class=\"event-image-wrapper\">
        <img src=\"\${imageUrl}\" alt=\"\${event.title}\" class=\"event-image\" loading=\"lazy\" 
             onerror=\"this.src='/themes/custom/events_theme/images/placeholder.jpg'\">
        <div class=\"date-badge\">\${formattedDate}</div>
      </div>
      <div class=\"event-content\">
        <h3 class=\"event-title\"><a href=\"/node/\${event.id}\">\${event.title}</a></h3>
        <span class=\"category-chip\">\${categoryName}</span>
        <div class=\"event-location\">\${location}</div>
        <p class=\"event-summary\">\${summary}</p>
      </div>
    `;
    return article;
  }
})();
</script>

<style>
.filter-bar { display: flex; gap: 1rem; margin-bottom: 2rem; align-items: end; }
.filter-group { display: flex; flex-direction: column; }
.filter-group label { margin-bottom: 0.3rem; font-weight: 500; }
.filter-group select, .filter-group input { padding: 0.6rem; border: 1px solid #ddd; border-radius: 4px; }
.filter-submit, .clear-button { 
  padding: 0.6rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; 
  color: white; font-weight: 500;
}
.filter-submit { background: #007bff; }
.clear-button { background: #6c757d; margin-left: 0.5rem; }
.clear-button:hover { background: #5a6268; }
.loading, .no-events, .error { 
  grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666; 
}
@media (max-width: 768px) { .filter-bar { flex-direction: column; align-items: stretch; } }
</style>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/events_theme/templates/page--front.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  114 => 64,  66 => 18,  60 => 15,  57 => 14,  55 => 13,  50 => 11,  44 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/events_theme/templates/page--front.html.twig", "C:\\Xampp_New\\htdocs\\drupal\\install-dir\\web\\themes\\custom\\events_theme\\templates\\page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 13];
        static $filters = ["escape" => 15, "date" => 64];
        static $functions = ["path" => 11];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'date'],
                ['path'],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
