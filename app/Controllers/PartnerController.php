<?php

namespace App\Controllers;

class PartnerController extends BaseController
{
    protected $cache;
    protected $useCache;
    protected $cacheTime;

    public function __construct() {
        $this->cache = \Config\Services::cache(); // Load the cache service
        $this->useCache = getenv('CI_ENVIRONMENT') === 'production'; // Only use cache in production
        $this->cacheTime = getenv('CI_CACHE_TIME') ? (int)getenv('CI_CACHE_TIME') : 600; // Cache time in seconds (10 minutes)
    }

    public function partnerHome()
    {
        if (!$this->checkSession()) {
            return redirect()->to('/customer_login');
        }
        return $this->renderView('partner_home_view', 'partner/partner_home');
    }

    public function productDetails()
    {
        if (!$this->checkSession()) {
            return redirect()->to('/customer_login');
        }
        return $this->renderView('product_details_view', 'partner/dashboard/product_details');
    }
    public function Market()
    {
        if (!$this->checkSession()) {
            return redirect()->to('/customer_login');
        }
        return $this->renderView('market_view', 'partner/dashboard/market');
    }
    public function Portfolio()
    {
        if (!$this->checkSession()) {
            return redirect()->to('/customer_login');
        }
        return $this->renderView('market_view', 'partner/dashboard/portfolio');
    }

    /**
     * Renders content from cache if available, otherwise generates and caches it.
     *
     * @param string $cacheKey The cache key to use.
     * @param callable $contentGenerator A callable that generates the content if cache is missed.
     * @return string The cached or generated content.
     */
    private function renderCache(string $cacheKey, callable $contentGenerator): string
    {
        if ($this->useCache) {
            $cachedContent = $this->cache->get($cacheKey);

            if ($cachedContent === null) {
                // Cache miss, generate the content
                $cachedContent = $contentGenerator();
                // Save the content to the cache
                $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
            }

            return $cachedContent;
        } else {
            // Cache disabled, generate the content directly
            return $contentGenerator();
        }
    }

    private function renderView(string $cacheKey, string $viewName, array $data = []): string
    {
        return $this->renderCache($cacheKey, function() use ($viewName, $data) {
            // Always get user data for every view
            $userData = session()->get('user_data') ?? [];
            $userData = is_array($userData) && !empty($userData) ? $userData[0] : [];
            
            // Merge $userData with additional data passed to the method
            $viewData = array_merge(['userData' => $userData], $data);

            return view('partner/partner_header', $viewData)
                . view('partner/partner_sidebar', $viewData)
                . view($viewName, $viewData);
        });
    }

    /**
     * Checks if the user session is active.
     *
     * @return bool True if the session is active, false otherwise.
     */
    private function checkSession(): bool
    {
        return session()->has('user_data');
    }

}
