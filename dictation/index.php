
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dictation - Online Speech Recognition</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Amit Agarwal">
  <meta name="description" content="Dictation is a free online speech recognition software that will help you write emails, documents and essays using your voice narration and without typing." />
  <meta name="google-site-verification" content="fcnrbrpQfdBT0yQAtKojm8bTMd5hfIcnnTFJxyUXLV8" />
  <link rel="alternate" type="application/rss+xml" title="Digital Inspiration" href="http://feeds.labnol.org/labnol" />
  <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href="dictation.css" rel="stylesheet">
</head>

<body>
  <div class="top">
    <a href="#" onclick="toggleVisibility('about');return false;" class="btn">About</a>
    <a href="#" onclick="toggleVisibility('commands'); return false;" class="btn">Commands</a>
    <a class="btn" title="Add Speech Recognition to your Website" href="http://www.labnol.org/software/add-speech-recognition-to-website/19989/">Add to Website</a>
    <a href="https://chrome.google.com/webstore/detail/voice-recognition/ikjmfindklfaonkodbnidahohdfbdhkn" target="_blank" class="btn">Chrome App</a>
    <a href="https://www.youtube.com/watch?v=fDX-RVCmfWU" target="_blank" class="btn">Video</a>
  </div>

  <div class="info" id="about">
    <h1>Speech Recognition in the Browser</h1>
    <p>With Dictation, you can use the magic of speech recognition to write emails, narrate essays and long documents in the browser without touching the keyboard.</p>
    <p>To get started, just connect the microphone to your computer and click the Start Dictation button.</p>
    <p>Dictation uses your browser's local Storage to save all the transcribed text automatically as you speak. That means you can close the browser and it will resume from where you left off.</p>
    <p>The app internally uses the built-in speech recognition engine of Google Chrome to transform your voice into digital text. </p>
    <h3>Speak in your Native Language</h3>
    <p>You don't have to speak in English as Chrome's engine can recognize quite a few languages including Arabic, Chinese, Spanish, French, German, Italian, Malay, Indonesian and more. Dictation will automatically determine your browser's default launguage
      and uses it for subsequent transcriptions.</p>
    <p>Hindi is the only Indian language that is supported at this time.</p>
    <p>Written by <a href="https://ctrlq.org/">Amit Agarwal</a> for <a href="http://www.labnol.org/">Digital Inspiration</a>.</p>
    <p><a href="#" onclick="toggleVisibility('1'); return false;">Close</a></p>
  </div>
  <div class="info" id="commands">
    <h2>Dictation Commands and Tips</h2>
    <p>You can narrate long sentences in one go and Chrome's built-in speech recognition will transcribe them simultaneously. See <a href="https://www.youtube.com/watch?v=fDX-RVCmfWU&hd=1" target="_blank">video demo</a>.</p>
    <p>1. Say "New Paragraph" to begin a new paragraph</p>
    <p>2. Say "Comma", "Full Stop", "Question Mark" for punctuation</p>
    <p>3. Click the "Stop Listening" button to end the speech recognition session. You can click the "Start" button again to resume transcription.</p>
    <h3>Web Speech API in Google Chrome</h3>
    <p>Dictation uses the x-webkit-speech attribute of HTML5 that is only implemented in Google Chrome. This attribute is only implemented for &lt;input&gt; (single-line) form fields so Dictation uses a workaround. It hides the speech-enabled input behind
      the microphone icon and appends the transcribed text to a regular DIV.</p>
    <p><a href="#" onclick="toggleVisibility('1'); return false;">Close</a></p>
  </div>


  <div class="notepad">
    <div class="notepad-heading">
      <h1>Online Dictation</h1>
    </div>
    <div id="speech">
      <span id="labnol" contenteditable="true"></span>
      <span id="notfinal"></span>
      <span id="warning"></span>
    </div>
    <div class="whatisthis">
      <span id="messages">
        <a href="#" onclick="javascript:action();return false;" id="btn">Loading..</a>
        <a href="#" onclick="javascript:clearSlate();return false;" id="btnClear">Clear</a>
        <a href="#" onclick="javascript:save();return false;" id="btnClear" title="Download your text">Save</a>
        <img id="status" src="listen.gif" />
      </span>
    </div>
  </div>

  <div class="platforms" id="platformslang">
    <span class="language">
      <select name="lang" id="lang" onchange="updateLang(this)">
        <option value="af-ZA">Afrikaans</option>
        <option value="id-ID">Bahasa Indonesia</option>
        <option value="ms-MY">Bahasa Melayu</option>
        <option value="ca-ES">Català</option>
        <option value="cs-CZ">Čeština</option>
        <option value="da-DK">Dansk</option>
        <option value="de-DE">Deutsch</option>
        <optgroup label="English">
          <option value="en-AU">Australia</option>
          <option value="en-CA">Canada</option>
          <option value="en-IN">India</option>
          <option value="en-NZ">New Zealand</option>
          <option value="en-ZA">South Africa</option>
          <option value="en-GB">United Kingdom</option>
          <option value="en-US" selected>United States</option>
        </optgroup>
        <optgroup label="Español">
          <option value="es-AR">Argentina</option>
          <option value="es-BO">Bolivia</option>
          <option value="es-CL">Chile</option>
          <option value="es-CO">Colombia</option>
          <option value="es-CR">Costa Rica</option>
          <option value="es-EC">Ecuador</option>
          <option value="es-SV">El Salvador</option>
          <option value="es-ES">España</option>
          <option value="es-US">Estados Unidos</option>
          <option value="es-GT">Guatemala</option>
          <option value="es-HN">Honduras</option>
          <option value="es-MX">México</option>
          <option value="es-NI">Nicaragua</option>
          <option value="es-PA">Panamá</option>
          <option value="es-PY">Paraguay</option>
          <option value="es-PE">Perú</option>
          <option value="es-PR">Puerto Rico</option>
          <option value="es-DO">República Dominicana</option>
          <option value="es-UY">Uruguay</option>
          <option value="es-VE">Venezuela</option>
        </optgroup>
        <option value="eu-ES">Euskara</option>
        <option value="fil-PH">Filipino</option>
        <option value="fr-FR">Français</option>
        <option value="gl-ES">Galego</option>
        <option value="hi-IN">हिन्दी</option>
        <option value="hr_HR">Hrvatski</option>
        <option value="zu-ZA">IsiZulu</option>
        <option value="is-IS">Íslenska</option>
        <optgroup label="Italiano">
          <option value="it-IT">Italia</option>
          <option value="it-CH">Svizzera</option>
        </optgroup>
        <option value="lt-LT">Lietuvių</option>
        <option value="hu-HU">Magyar</option>
        <option value="nl-NL">Nederlands</option>
        <option value="nb-NO">Norsk bokmål</option>
        <option value="pl-PL">Polski</option>
        <optgroup label="Português">
          <option value="pt-BR">Brasil</option>
          <option value="pt-PT">Portugal</option>
        </optgroup>
        <option value="ro-RO">Română</option>
        <option value="sl-SI">Slovenščina</option>
        <option value="sk-SK">Slovenčina</option>
        <option value="fi-FI">Suomi</option>
        <option value="sv-SE">Svenska</option>
        <option value="vi-VN">Tiếng Việt</option>
        <option value="th-TH">ภาษาไทย</option>
        <option value="tr-TR">Türkçe</option>
        <option value="el-GR">Ελληνικά</option>
        <option value="bg-BG">български</option>
        <option value="ru-RU">Pусский</option>
        <option value="sr-RS">Српски</option>
        <option value="uk-UA">Українська</option>
        <option value="ko-KR">한국어</option>
        <optgroup label="中文">
          <option value="cmn-Hans-CN">普通话 (中国大陆)</option>
          <option value="cmn-Hans-HK">普通话 (香港)</option>
          <option value="cmn-Hant-TW">中文 (台灣)</option>
          <option value="yue-Hant-HK">粵語 (香港)</option>
        </optgroup>
        <option value="ja-JP">日本語</option>
      </select>
    </span>
  </div>
  <div class="addthis_toolbox addthis_default_style social">
    <a class="addthis_button_tweet" tw:related="labnol,howto_guides" tw:count="none" tw:via="labnol" tw:text="I love dictation.io - a free voice recognition app that works in the browser."></a> &nbsp;
    <a tf:show-screen-name="false" class="addthis_button_twitter_follow_native" tf:screen_name="labnol" tf:show-count="false"></a>
    <a class="addthis_button_facebook_like" fb:like:layout="button_count" addthis:url="http://www.facebook.com/digital.inspiration"></a>
  </div>
  <div id=fb-root></div>
  <script src="filesaver.js"></script>
  <script src="dictation.js"></script>
  <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-50062-33', 'dictation.io');
    ga('send', 'pageview');
</script>

  <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=labnol"></script>

  <script>
  UserVoice=window.UserVoice||[];(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/WgTPAq6J1u0Fg5nXLMPTA.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})();
  UserVoice.push(['set', {
    accent_color: '#808283',
    trigger_color: 'white',
    trigger_background_color: '#448dd6'
  }]);
  UserVoice.push(['addTrigger', {mode: 'contact', trigger_position: 'bottom-right' }]);
  UserVoice.push(['autoprompt', {}]);
</script>

</body>

</html>
