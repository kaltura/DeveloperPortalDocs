
# SessionProvider
Interface, defines the base requirements of an implementing element to enable access
to a remote data source by the Players components.
Components such as Media Providers and some of the OVP plugins, that needs to connect
to the remote data source and request actions, get data, update data, works with
the SessionProvider.

SessoinProvider provides:
1. Base url - url to connect to a remote data source.
2. Session Token - a valid session key to work against the data source.
3. PartnerId - The partner, that was used to create the session token.


**You can create your own SessionProvider implementation or use the provided SDK implementations.**


### Creating a SessionProvider

* **Self implemented:**
  Using anonymous interface instantiation or implementing class.

```
 SessionProvider sessionProvider = new SessionProvider() {
            @Override
            public String baseUrl() {
                return baseUrl;
            }

            @Override
            public void getKs(OnCompletion<PrimitiveResult> completion) {
                completion.onComplete(new PrimitiveResult(getKs()));
            }

            @Override
            public int partnerId() {
                return partnerId();
            }
        };
```

* **Provided implementations:**
OttSessionProvider and OvpSessionProvider.

  * **[OttSessionProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/phoenix/OttSessionProvider.java)**

   The OttSessionProvider supports, anonymous and user specific session creation, on Phoenix BE.

   Anonymous session starts with "ottUser/anonymousLogin" API.
   User specific session starts with "ottUser/login" API, according to username and password.

   The provider handles the refreshes of the session token when needed, before it expires
   and renew the session if did.
   On Every session token fetching request, the session provider checks the current token
   validity, and if expires and can be renewed, renews it.

   User session can be ended, by that making the session token invalid. Further requests
   with that token will fail.
   Once session was ended it can't be renewed, and new session should be started.
   Session ending is done with "ottUser/logout" API.

   Anonymous session can't be ended. Until the session token (ks) gets expired the
   token can be used.

   After session started, the SessionProvider is ready and can be used as parameter
   to the media providers and other components.

   **How to use:**

    ```
    OttSessionProvider ottSessionProvider = new OttSessionProvider(PhoenixBaseUrl, partnerId);
    ottSessionProvider.startSession(username, password, udid, new OnComplition<PrimitiveRersult>(){
     @Override
        public void onComplete(PrimitiveResult response) {
            if(response.isSuccess()) { // has valid session:

                phoenixMediaProvider = new PhoenixMediaProvider()
                              .setSessionProvider(ottSessionProvider)
                              .setReferenceType(APIDefines.AssetReferenceType.Media)
                              .setAssetId(ChannelId)
                              .setFormats(FormatHD, FormatSD);

                phoenixMediaProvider.load(new OnMediaLoadCompletion() {
                    @Override
                    public void onComplete(ResultElement<PKMediaEntry> response) {
                      ...
                    }
                });

            } else { // error: session creation failed
              ErrorElement error = response.getError();
            }
        }
    });

    ```
  *  **[OvpSessionProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/ovp/OvpSessionProvider.java)**

   The OvpSessionProvider supports, anonymous and user specific session creation, on OVP BE.

   Anonymous session starts with "session/startWidgetSession" API.
   User specific session starts with "user/loginByLoginId" API

   By default session is valid for 24h.
   Once expired, the OvpSessionProvider will try to renew the session.

   User session can be ended, by that making the session token invalid. Further requests
   with that token will fail.
   Once session was ended it can't be renewed, and new session should be started.
   Session ending is done with "session/end" API.

   Anonymous session can't be ended. Until the session token (ks) gets expired the
   token can be used.

   After session started, the SessionProvider is ready and can be used as parameter
   to the media providers and other components.

   **How to use:**

      ```
      OvpSessionProvider ovpSessionProvider = new OvpSessionProvider(OvpBaseUrl);
      ovpSessionProvider.startAnonymousSession(partnerId, new OnComplition<PrimitiveRersult>(){
       @Override
          public void onComplete(PrimitiveResult response) {
              if(response.isSuccess()) { // has valid session:

                  kalturaOvpMediaProvider = new KalturaOvpMediaProvider()
                                .setSessionProvider(ovpSessionProvider)
                                .setEntryId(EntryId);

                  kalturaOvpMediaProvider.load(new OnMediaLoadCompletion() {
                      @Override
                      public void onComplete(ResultElement<PKMediaEntry> response) {
                        ...
                      }
                  });

              } else { // error: session creation failed
                ErrorElement error = response.getError();
              }
          }
      });

      ```
