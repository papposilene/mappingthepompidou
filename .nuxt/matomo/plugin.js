import { debug, warn, isFn, waitUntil, routeOption } from './utils'

export default (context, inject) => {
  const { app: { router, store } } = context

  let tracker
  if (window.Piwik) {
    tracker = createTracker()
  } else {
    // if window.Piwik is not (yet) available, add a Proxy which delays calls
    // to the tracker and execute them once the Piwik tracker becomes available
    let _tracker // The real Piwik tracker
    let delayedCalls = []
    const proxyTrackerCall = (fnName, ...args) => {
      if (_tracker) {
        return _tracker[fnName](...args)
      }

      debug(`Delaying call to tracker: ${fnName}`)

      delayedCalls.push([fnName, ...args])
    }

    if (typeof Proxy === 'function') {
      // Create a Proxy for any tracker property (IE11+)
      tracker = new Proxy({}, {
        get (target, key) {
          return (...args) => proxyTrackerCall(key, ...args)
        }
      })
    } else {
      tracker = {};
      [
        'getHook',
        'getQuery',
        'getContent',
        'isUsingAlwaysUseSendBeacon',
        'buildContentImpressionRequest',
        'buildContentInteractionRequest',
        'buildContentInteractionRequestNode',
        'getContentImpressionsRequestsFromNodes',
        'getCurrentlyVisibleContentImpressionsRequestsIfNotTrackedYet',
        'trackCallbackOnLoad',
        'trackCallbackOnReady',
        'buildContentImpressionsRequests',
        'wasContentImpressionAlreadyTracked',
        'appendContentInteractionToRequestIfPossible',
        'setupInteractionsTracking',
        'trackContentImpressionClickInteraction',
        'internalIsNodeVisible',
        'isNodeAuthorizedToTriggerInteraction',
        'getDomains',
        'getConfigIdPageView',
        'getConfigDownloadExtensions',
        'enableTrackOnlyVisibleContent',
        'clearTrackedContentImpressions',
        'getTrackedContentImpressions',
        'clearEnableTrackOnlyVisibleContent',
        'disableLinkTracking',
        'getConfigVisitorCookieTimeout',
        'getConfigCookieSameSite',
        'removeAllAsyncTrackersButFirst',
        'getConsentRequestsQueue',
        'getRequestQueue',
        'unsetPageIsUnloading',
        'getRemainingVisitorCookieTimeout',
        'hasConsent',
        'getVisitorId',
        'getVisitorInfo',
        'getAttributionInfo',
        'getAttributionCampaignName',
        'getAttributionCampaignKeyword',
        'getAttributionReferrerTimestamp',
        'getAttributionReferrerUrl',
        'setTrackerUrl',
        'getTrackerUrl',
        'getMatomoUrl',
        'getPiwikUrl',
        'addTracker',
        'getSiteId',
        'setSiteId',
        'resetUserId',
        'setUserId',
        'setVisitorId',
        'getUserId',
        'setCustomData',
        'getCustomData',
        'setCustomRequestProcessing',
        'appendToTrackingUrl',
        'getRequest',
        'addPlugin',
        'setCustomDimension',
        'getCustomDimension',
        'deleteCustomDimension',
        'setCustomVariable',
        'getCustomVariable',
        'deleteCustomVariable',
        'deleteCustomVariables',
        'storeCustomVariablesInCookie',
        'setLinkTrackingTimer',
        'getLinkTrackingTimer',
        'setDownloadExtensions',
        'addDownloadExtensions',
        'removeDownloadExtensions',
        'setDomains',
        'enableCrossDomainLinking',
        'disableCrossDomainLinking',
        'isCrossDomainLinkingEnabled',
        'setCrossDomainLinkingTimeout',
        'getCrossDomainLinkingUrlParameter',
        'setIgnoreClasses',
        'setRequestMethod',
        'setRequestContentType',
        'setGenerationTimeMs',
        'setReferrerUrl',
        'setCustomUrl',
        'getCurrentUrl',
        'setDocumentTitle',
        'setAPIUrl',
        'setDownloadClasses',
        'setLinkClasses',
        'setCampaignNameKey',
        'setCampaignKeywordKey',
        'discardHashTag',
        'setCookieNamePrefix',
        'setCookieDomain',
        'getCookieDomain',
        'hasCookies',
        'setSessionCookie',
        'getCookie',
        'setCookiePath',
        'getCookiePath',
        'setVisitorCookieTimeout',
        'setSessionCookieTimeout',
        'getSessionCookieTimeout',
        'setReferralCookieTimeout',
        'setConversionAttributionFirstReferrer',
        'setSecureCookie',
        'setCookieSameSite',
        'disableCookies',
        'areCookiesEnabled',
        'setCookieConsentGiven',
        'requireCookieConsent',
        'getRememberedCookieConsent',
        'forgetCookieConsentGiven',
        'rememberCookieConsentGiven',
        'deleteCookies',
        'setDoNotTrack',
        'alwaysUseSendBeacon',
        'disableAlwaysUseSendBeacon',
        'addListener',
        'enableLinkTracking',
        'enableJSErrorTracking',
        'disablePerformanceTracking',
        'enableHeartBeatTimer',
        'disableHeartBeatTimer',
        'killFrame',
        'redirectFile',
        'setCountPreRendered',
        'trackGoal',
        'trackLink',
        'getNumTrackedPageViews',
        'trackPageView',
        'trackAllContentImpressions',
        'trackVisibleContentImpressions',
        'trackContentImpression',
        'trackContentImpressionsWithinNode',
        'trackContentInteraction',
        'trackContentInteractionNode',
        'logAllContentBlocksOnPage',
        'trackEvent',
        'trackSiteSearch',
        'setEcommerceView',
        'getEcommerceItems',
        'addEcommerceItem',
        'removeEcommerceItem',
        'clearEcommerceCart',
        'trackEcommerceOrder',
        'trackEcommerceCartUpdate',
        'trackRequest',
        'ping',
        'disableQueueRequest',
        'setRequestQueueInterval',
        'queueRequest',
        'isConsentRequired',
        'getRememberedConsent',
        'hasRememberedConsent',
        'requireConsent',
        'setConsentGiven',
        'rememberConsentGiven',
        'forgetConsentGiven',
        'isUserOptedOut',
        'optUserOut',
        'forgetUserOptOut'
      ].forEach((fnName) => {
        // IE9/10 dont support Proxies, create a proxy map for known api methods
        tracker[fnName] = (...args) => proxyTrackerCall(fnName, ...args)
      })
    }

    // Log a warning when piwik doesnt become available within 10s (in debug mode)
    const hasPiwikCheck = setTimeout(() => {
      if (!window.Piwik) {
        debug(`window.Piwik was not set within timeout`)
      }
    }, 10000)

    // Use a getter/setter to know when window.Piwik becomes available
    let _windowPiwik
    Object.defineProperty(window, 'Piwik', {
      configurable: true,
      enumerable: true,
      get () {
        return _windowPiwik
      },
      set (newVal) {
        clearTimeout(hasPiwikCheck)
        if (_windowPiwik) {
          debug(`window.Piwik is already defined`)
        }

        _windowPiwik = newVal
        _tracker = createTracker(delayedCalls)
        delayedCalls = undefined
      }
    })
  }

  // inject tracker into app & context
  context.$matomo = tracker
  inject('matomo', tracker)

  // define base url
  const baseUrl = window.location.protocol +
    (window.location.protocol.slice(-1) === ':' ? '' : ':') +
    '//' +
    window.location.host +
    router.options.base.replace(/\/+$/, '')

  const trackRoute = ({ to, componentOption }) => {
    // we might not know the to's page title in vue-router.afterEach, DOM is updated _after_ afterEach
    tracker.setDocumentTitle(to.path)

    tracker.setCustomUrl(baseUrl + to.fullPath)

    // allow override page settings
    const settings = Object.assign(
      {},
      context.route.meta && context.route.meta.matomo,
      componentOption
    )

    for (const key in settings) {
      const setting = settings[key]
      const fn = setting.shift()
      if (isFn(tracker[fn])) {
        debug(`Calling matomo.${fn} with args ${JSON.stringify(setting)}`)

        tracker[fn].call(null, ...setting)
      } else {
        debug(`Unknown matomo function ${fn} with args ${JSON.stringify(setting)}`)
      }
    }

    debug(`Tell matomo to track pageview ${to.fullPath}`, document.title)

    // tell Matomo to add a page view (doesnt do anything if tracker is disabled)
    tracker.trackPageView()
  }

  // every time the route changes (fired on initialization too)
  router.afterEach((to, from) => {
    const componentOption = routeOption('matomo', tracker, from, to, store)
    if (componentOption === false) {
      debug(`Component option returned false, wont (automatically) track pageview ${to.fullPath}`)

      return
    }

    trackRoute({ to, componentOption })
  })
}

function createTracker (delayedCalls = []) {
  if (!window.Piwik) {
    debug(`window.Piwik not initialized, unable to create a tracker`)

    return
  }

  const tracker = window.Piwik.getTracker('//pwk.psln.nl/piwik.php', '12')

  // extend tracker
  tracker.setConsent = (val) => {
    if (val || val === undefined) {
      tracker.setConsentGiven()
    } else {
      tracker.forgetConsentGiven()
    }
  }

  debug(`Created tracker for siteId 12 to //pwk.psln.nl/piwik.php`)

  // wrap all Piwik functions for verbose logging
  Object.keys(tracker).forEach((key) => {
    const fn = tracker[key]
    if (isFn(fn)) {
      tracker[key] = (...args) => {
        debug(`Calling tracker.${key} with args ${JSON.stringify(args)}`)
        return fn.call(tracker, ...args)
      }
    }
  })

  tracker.setDoNotTrack(true)

  while (delayedCalls.length) {
    const [fnName, ...args] = delayedCalls.shift()
    if (isFn(tracker[fnName])) {
      debug(`Calling delayed ${fnName} on tracker`)

      tracker[fnName](...args)
    }
  }

  return tracker
}