---
layout: default
---
<div class="w-section thank-you-section">
    <div class="w-container">
      <h1 class="section-headings success-heading thank-you-heading">Thank You for Signing Up!<br /><span class="success-subheading">Your Kaltura VPaaS Account is Ready</span></h1>
      <div class="success-account-details">
        <div class="w-row">
          <div class="w-col w-col-12">
            <div class="get-you-started-div">
              <h3 class="thank-you-h3">Lets Get You Started</h3>
              <h4 class="thank-you-h4">Confirm Your Email</h4>
              <p class="thank-you-p mail-confirmation" style="font-weight: bold;">Look for the verification email in your inbox and click the link in the email to activate your new account and create a password.</p>
              <h4 class="thank-you-h4">YOUR Kaltura Account Id (Patrner Id)</h4>
              <input type="text" value="Your partnerId: <?php echo $_GET['partner_id']; ?>" readonly="" size="24" style="background: transparent;font-size: 12px;border: solid 1px #9EB4B7;margin-bottom: 8px;border-radius: 4px;padding: 2px;padding-left: 6px;">
              <p class="thank-you-p">Your Kaltura Partner ID, or PID, is a unique number identifying your Kaltura account.</p>

              <h4 class="thank-you-h4">Kaltura Session</h4>
              <input type="text" value="<?php echo $_GET['ks']; ?>" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px; width: 100%;">
              <p class="thank-you-p">The string above is a Kaltura Session (aka KS). The KS authenticates the account and user when making an API call. You are expected to provide a generated KS with every API call you make.
              <br />
              There are three methods for generating a Kaltura Session:</p>
              <ul class="case-study-template-list-wrapper-bullets">
                <li class="case-study-template-li-bullets">Calling the&nbsp;<span class="code-highlight">session.start</span>&nbsp;action. This method is recommended for scripts and applications that only you run and maintain.</li>
                <li class="case-study-template-li-bullets">Calling&nbsp;<span class="code-highlight">user.loginByLoginId</span> action. This method is recommended for managing registered users in Kaltura, and allowing users to login using email and password.</li>
                <li class="case-study-template-li-bullets">Using the&nbsp;<span class="code-highlight">appToken</span> service. This method is recommended for when you are providing access to scripts or applications that are managed by others, and provides tools to manage API tokens per application provider, revoke access, and more.</li>
              </ul>
              <blockquote class="recipes-ref-list">
                <strong>Learn &amp; explore with Code Recipes:</strong> 
                <ul>
                  <li><a href="https://developer.kaltura.com/recipes/authentication" target="_blank">Creating KS using session or user services.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/app_tokens" target="_blank">Managing applications access with the appTokens service.</a></li>
                </ul>
              </blockquote>

              <h4 class="thank-you-h4">Kaltura Entries</h4>
              <p class="thank-you-p">Content assets are called entries in Kaltura. An entry is a logical object representing all aspects of the media asset including its metadata, thumbnails, transcoded flavors, captions, cue-points (timed metadata), and more. Every entry is referenced by its unique identifier, the Entry Id.</p>
              <input type="text" value="Entry from your account: <?php echo $_GET['entry_id']; ?>" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px; width: 100%;">
              <p class="thank-you-p">In Kaltura you can manage various types of assets, including on-demand media assets (video, audio, and image files), live stream video or audio broadcasts, as well as playlists, documents and other special data files.</p>
              <p class="thank-you-p">Kaltura entries come with basic metadata fields such as title, description and tags. You can enrich the metadata fields available for your entries by adding your own custom metadata profiles and fields. These metadata fields can then be used for smarter search queries or as rules in processes and workflows.</p>
              <blockquote class="recipes-ref-list">
                <strong>Learn &amp; explore with Code Recipes:</strong> 
                <ul>
                  <li><a href="https://developer.kaltura.com/recipes/upload" target="_blank">Create and upload on-demand media files.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/live_broadcast" target="_blank">Create live broadcast and stream live from webcam.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/video_search" target="_blank">List and search entries.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/metadata" target="_blank">Work with custom metadata.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/code_cue_points" target="_blank">Timed metadata using cue points.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/captions" target="_blank">Upload captions and run in-video search.</a></li>
                </ul>
              </blockquote>
              
              <h4 class="thank-you-h4">Kaltura Player &amp; uiConf</h4>
              <p class="thank-you-p">Kaltura also features a web-standards cross-pltform video player library. The player abstracts the complexities around delivery of video across devices, browsers and native apps and the user-experience with your video including controls UI and branding through in-video quizzes and ads, all with a single embed code.
              <br />The Kaltura Player unified JavaScript API for integrations and plugins further simplifies embedding and integrating the player into pages and apps quickly and at ease without compromising on design or features.</p>
              <input type="text" value="Player instance uiConf from your account: <?php echo $_GET['ui_conf_id']; ?>" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px; width: 100%;">
              <p class="thank-you-p">The id above is called uiConf Id. This id is used to reference the player instance you wish to use when embedding a video in your pages or app views.</p>
              <p class="thank-you-p">There are a number of methods to embed players. All methods require these base parameters: <span class="code-highlight">partnerId</span>, <span class="code-highlight">uiConfId</span> and <span class="code-highlight">entryId</span>.
              <br/>For example, this is a player embed code of a player and video entry from your account:</p>
              
              <div class="highlighter-rouge"><pre class="highlight"><code><span class="nx">kWidget</span><span class="p">.</span><span class="nx">embed</span><span class="p">({</span>
    <span class="s1">'targetId'</span><span class="p">:</span> <span class="s1">'kaltura_player'</span><span class="p">,</span>
    <span class="s1">'wid'</span><span class="p">:</span> <span class="s1">'_<?php echo $_GET['partner_id']; ?>'</span><span class="p">,</span>
    <span class="s1">'uiconf_id'</span> <span class="p">:</span> <span class="s1">'<?php echo $_GET['ui_conf_id']; ?>'</span><span class="p">,</span>
    <span class="s1">'entry_id'</span> <span class="p">:</span> <span class="s1">'<?php echo $_GET['entry_id']; ?>'</span><span class="p">,</span>
    <span class="s1">'flashvars'</span> <span class="p">:</span> <span class="p">{</span>
        <span class="c1">// adding valid Kaltura Session to your player embeds will ensure Engagement Analytics will be counted per authenticated user ids. Remove the KS, if you desire anonymous playback:</span>
        <span class="s1">'ks'</span><span class="p">:</span> <span class="s1">'<?php echo $_GET['ks']; ?>'</span><span class="p">,</span>
    <span class="p">}</span>
<span class="p">});</span>
</code></pre>
</div>
              
              <div class="w-embed w-iframe w-script media-embed-div">
                <!-- Outer div defines maximum space the player can take -->
                <div style="width: 100%;display: inline-block;position: relative;">
                  <!--  inner pusher div defines aspect ratio: in this case 16:9 ~ 56.25% -->
                  <div id="dummy" style="margin-top: 56.25%;"></div>
                  <!--  the player embed target, set to take up available absolute space   -->
                  <script src="https://cdnapisec.kaltura.com/p/346/sp/34600/embedIframeJs/uiconf_id/34599271/partner_id/346" style="margin: 0px 0px 0px 0px;"></script>
                  <div id="kaltura_player_1461185766" style="position:absolute;top:0;left:0;left: 0;right: 0;bottom:0;border:none;"></div>
                </div>
                <script>
                  kWidget.embed({
                    "targetId": "kaltura_player_1461185766",
                    "wid": "_346",
                    "uiconf_id": 34599271,
                    "flashvars": {
                      "streamerType": "auto"
                    },
                    "cache_st": 1461185766,
                    "entry_id": "0_dkntmqqu"
                  });
                </script>
              </div>

              <blockquote class="recipes-ref-list">
                <strong>Learn &amp; explore with Code Recipes:</strong> 
                <ul>
                  <li><a href="http://player.kaltura.com/docs/kwidget" target="_blank">JavaScript function for player embed method.</a></li>
                  <li><a href="http://player.kaltura.com/docs/autoEmbed" target="_blank">JavaScript tag player embed.</a></li>
                  <li><a href="http://player.kaltura.com/docs/responsive" target="_blank">Example reference for responsive player embed.</a></li>
                  <li><a href="http://player.kaltura.com/docs/thumb" target="_blank">JavaScript function thmbnail embed (click turns thumbnail to player).</a></li>
                  <li><a href="http://player.kaltura.com/docs/NativeCallout" target="_blank">Enables a robust web to native bridge.</a></li>
                  <li><a href="http://player.kaltura.com/docs/thumb" target="_blank">JavaScript function thmbnail embed (click turns thumbnail to player).</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/player_uiconf" target="_blank">Working with the uiConf service.</a></li>
                </ul>
              </blockquote>

              <div id="spacer-bottom" style="width: 10px;height: 40px;"></div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
