---
layout: default
---
<script>
$( document ).ready(function() {
    $('.thank-you-heading').fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200).delay(6000).fadeOut(1000);
};
</script>
<div class="w-section thank-you-section">
    <div class="w-container">
        <div class="section-headings success-heading thank-you-heading">
          <h1>Thank You for Signing Up!</h1>
          <h2 class="success-subheading" style="font-weight: normal;margin-bottom: 0;">Please Confirm Your Email Address</h2>
          <p class="thank-you-p mail-confirmation" style="font-weight: bold;font-size: 14px;color: gray;margin: 0 auto;max-width: 470px;font-weight: normal;">Look for the verification email in your inbox and click the link in the email to activate your new account.</p>
        </div>
      <div class="success-account-details">
        <div class="w-row">
          <div class="w-col w-col-12">
            <div class="get-you-started-div">
              <h3 class="thank-you-h3">Let&apos;s Get You Started</h3>
                  <ul>
                    <li><a href="#partnerid">partnerId (Kaltura Account ID)</a></li>
                    <li><a href="#ks">ks (Kaltura API Session)</a></li>
                    <li><a href="#entryid">entryId (Media Asset Id)</a></li>
                    <li><a href="#uiconfid">uiConfId (Widget Instance Id)</a></li>
                </ul>
                <h4 class="thank-you-h4" name="embedexample">Video Player Embed</h4>
                <p class="thank-you-p">Playback is one of the key elements in your video experience. It is how you&apos;ll deliver the video to your users, how you interact with users while they watch the video (e.g. in-video quizzes, forms, ads, etc.), it is also how you ensure the right people get to watch your video (e.g. access control, rights management, parental control, and more) and how you will collect viewer engagement analytics about who, when and how they watch your video.</p>
                <p class="thank-you-p">The below example shows the most basic player embed, providing your account id, video id and player widget instance id.<br />In this quick start guide we will review these parameters, and get you started with all the important video experience and media workflow tools available in Kaltura VPaaS to make building video experiences and integrating video natively into your own applications.</p>
                <div class="w-row">
                    <div id="embedcode" class="w-col w-col-6">
                        <div class="highlighter-rouge" style="padding-right: 10px;"><pre class="highlight" style="margin: 0;background: none;"><code><span class="c1">kWidget</span><span class="p">.</span><span class="c1">embed</span><span class="p">({</span>
    <span class="s1">'targetId'</span><span class="p">:</span> <span class="s1">'kaltura_player'</span><span class="p">,</span>
    <span class="s1">'wid'</span><span class="p">:</span> <span class="s1">'_811441'</span><span class="p">,</span>
    <span class="s1">'uiconf_id'</span> <span class="p">:</span> <span class="s1">34599271</span><span class="p">,</span>
    <span class="s1">'entry_id'</span> <span class="p">:</span> <span class="s1">'0_4kwzg46z'</span><span class="p">,</span>
    <span class="s1">'flashvars'</span> <span class="p">:</span> <span class="p">{</span>
        <span class="nx">// Add dynamic configrations here such as page-specific or user-specific configs.</span>
    <span class="p">}</span>
<span class="p">});</span>
</code></pre>
                        </div>
                    </div>
                    <div id="embedplayer" class="w-col w-col-6">
                        <div class="w-embed w-iframe w-script media-embed-div">
                            <!-- Outer div defines maximum space the player can take -->
                            <div style="width: 100%;display: inline-block;position: relative;">
                              <!--  inner pusher div defines aspect ratio: in this case 16:9 ~ 56.25% -->
                              <div id="dummy" style="margin-top: 56.25%;"></div>
                              <!--  the player embed target, set to take up available absolute space   -->
                              <script src="https://cdnapisec.kaltura.com/p/811441/sp/81144100/embedIframeJs/uiconf_id/35015842/partner_id/811441" style="margin: 0px 0px 0px 0px;"></script>
                              <div id="kaltura_player_1461185766" style="position:absolute;top:0;left:0;left: 0;right: 0;bottom:0;border:none;"></div>
                            </div>
                            <script>
                              kWidget.embed({
                                "targetId": "kaltura_player_1461185766",
                                "wid": "_811441",
                                "uiconf_id": 35015842,
                                "flashvars": {
                                  "streamerType": "auto"
                                },
                                "entry_id": "0_4kwzg46z"
                              });
                            </script>
                        </div>
                    </div>
              </div>
              <h4 class="thank-you-h4" name="partnerid">Your Kaltura Account Id (Patrner Id)</h4>
              <input type="text" value="Your partnerId: <?php echo $_GET['partner_id'] ? $_GET['partner_id'] : '811441'; ?>" readonly="" size="24" style="background: transparent;font-size: 12px;border: solid 1px #9EB4B7;margin-bottom: 8px;border-radius: 4px;padding: 2px;padding-left: 6px;">
              <p class="thank-you-p">Your Kaltura Partner ID, or PID, is a unique number identifying your Kaltura account.<br />You will need to pass the pid paramemter everytime you authenticate with the Kaltura API, or connect with integrated apps.</p>

              <h4 class="thank-you-h4" name="ks">Kaltura Session</h4>
              <input type="text" value="<?php echo $_GET['ks'] ? $_GET['ks'] : 'djJ8MjEzOTQyMnxLngKd0BRQwS1EWdLV-T_Um8rRCed9mYyBwu_VOcglQ8mHlyvzAD8At9qPm2HgKoYMi5hdw3THj6ZXfAZGZyjE'; ?>" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px; width: 100%;">
              <p class="thank-you-p">The string above is a Kaltura Session (aka KS). The KS authenticates the account and user when making an API call. You are expected to provide a generated KS with every API call you will make.
              <br />
              There are three methods for generating a Kaltura Session:</p>
              <ul class="case-study-template-list-wrapper-bullets">
                <li class="thank-you-li-bullets">Calling the&nbsp;<span class="code-highlight"><a href="https://developer.kaltura.com/api-docs/#/session.start" target="_blank">session.start</a></span>&nbsp;action. This method is recommended for scripts and applications that only you will have access to.</li>
                <li class="thank-you-li-bullets">Calling&nbsp;<span class="code-highlight"><a href="https://developer.kaltura.com/api-docs/#/user.loginByLoginId" target="_blank">user.loginByLoginId</a></span> action. This method is recommended for managing registered users in Kaltura, and allowing users to login using email and password. When you login to the <a href="http://www.kaltura.com/index.php/kmc" target="_blank">Kaltura Management Console</a>, the KMC app calls the user.loginByLoginId action to authenticate you using your registered email and password.</li>
                <li class="thank-you-li-bullets">Using the&nbsp;<span class="code-highlight"><a href="https://developer.kaltura.com/api-docs/#/appToken" target="_blank">appToken</a></span> service. This method is recommended for when you are providing access to scripts or applications that are managed by others, and provides tools to manage API tokens per application provider, revoke access to specific applications, and more.</li>
              </ul>
              <blockquote class="recipes-ref-list">
                <strong>Learn &amp; explore with Code Recipes:</strong> 
                <ul>
                  <li><a href="https://developer.kaltura.com/recipes/authentication" target="_blank">Creating KS using session or user services.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/app_tokens" target="_blank">Managing applications access with the appTokens service.</a></li>
                </ul>
              </blockquote>

              <h4 class="thank-you-h4" name="entryid">Kaltura Entries</h4>
              <input type="text" size="50" value="A Kaltura Entry Id: <?php echo $_GET['entry_id'] ? $_GET['entry_id'] : '0_4kwzg46z'; ?>" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px;">
              <p class="thank-you-p">Content assets are called entries in Kaltura. An entry is a logical object representing all aspects of the media asset including its metadata, thumbnails, transcoded flavors, captions, cue-points (timed metadata), and more.</p>
              <p class="thank-you-p">In Kaltura you can manage various types of assets, including on-demand media assets (video, audio, and image files), live stream video or audio broadcasts, as well as playlists, documents and other special data files.</p>
              <p class="thank-you-p">Kaltura entries come with basic metadata fields such as title, description and tags, and you can enrich the metadata fields available for your entries by adding your own custom metadata profiles and fields. These metadata fields can then be used for smart search queries or as rules in access control, and workflows, and even as backend event triggers.</p>
              <blockquote class="recipes-ref-list">
                <strong>Learn &amp; explore with Code Recipes:</strong> 
                <ul>
                  <li><a href="https://developer.kaltura.com/recipes/upload" target="_blank">Create and upload on-demand media files.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/live_broadcast" target="_blank">Create live broadcast and stream live from webcam.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/video_search" target="_blank">List and search entries.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/metadata" target="_blank">Work with custom metadata.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/code_cue_points" target="_blank">Timed metadata using cue points.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/captions" target="_blank">Upload captions and run in-video search.</a></li>
                  <li><a href="https://developer.kaltura.com/recipes/backend_notifications" target="_blank">Working with Backend and Email Notifications.</a></li>
                </ul>
              </blockquote>
              
              <h4 class="thank-you-h4" name="uiconfid">Kaltura Player &amp; uiConf</h4>
              <p class="thank-you-p">A critical piece of every video workflow is the playback and the user-experience while interacting with video.<br />
              The Kaltura Video Player library abstracts the complexities around delivery of video across devices, browsers and native apps and the user-experience with your video. It provides a cross-platform rich UI framework, easy branding and customization features and even in-video quizzes, advertizing integrations, and a robust plugins-framework to create your own unique expeirences.<br />
              <br />The player further simplifies embedding and integrating the player into pages and apps by managing your player instances and configurations in the cloud, and providing the embed code a signle parameter - the uiConf Id.</p>
              <input type="text" value="Player instance uiConf id: <?php echo $_GET['ui_conf_id'] ? $_GET['ui_conf_id'] : '34599271'; ?>" size="50" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px;">
              <p class="thank-you-p">The uiConf Id is used to reference the player instance you wish to render when embedding a video in your pages or app views.</p>
              
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
