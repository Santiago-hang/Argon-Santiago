<footer id="footer" class="site-footer card shadow-sm border-0" style="padding: 18px 15px; margin-top: 15px;">
						<?php
							echo get_option('argon_footer_html');
							
							if (get_option('argon_footer_show_visitorinfo', 'true') != 'false') {
							$visitor_ip = argon_get_visitor_ip();
							$display_ip = $visitor_ip;
							if (strpos($display_ip, ':') !== false) {
								$display_ip = '[' . $display_ip . ']';
							}

							$ua_display = argon_get_visitor_ua_display();
						$os = $ua_display['platform'] ? $ua_display['platform'] : __('未知系统', 'argon');
						$os_version = $ua_display['platform_version'] ? $ua_display['platform_version'] : '';
						$os_icon = $ua_display['platform_icon'];
						$browser = $ua_display['browser'] ? $ua_display['browser'] : __('未知浏览器', 'argon');
						$browser_icon = $ua_display['browser_icon'];
						$version = $ua_display['version'] ? $ua_display['version'] : '';

							$visitor_ip_loc = argon_get_cached_ip_location($visitor_ip);
							$footer_ip_loc_async = ($visitor_ip_loc === null);
							}
						?>
						
												<?php
						$show_runtime = get_option('argon_footer_show_runtime', 'true') != 'false';
						$show_visitor = get_option('argon_footer_show_visitor', 'true') != 'false';
						if ($show_runtime || $show_visitor) {
						?>
<div class="footer-uptime" style="margin-bottom: 12px; font-size: 12.5px; display: flex; flex-wrap: wrap; justify-content: center; gap: 8px;">
							<?php if ($show_runtime) { ?>
							<span style="background: rgba(127,127,127,0.06); border: 1px solid rgba(127,127,127,0.1); padding: 3px 10px; border-radius: 6px; display: inline-block;">
								⏱️ 本站已稳定运行：<span id="web_runtime" style="font-family: monospace; font-weight: 600;">载入中...</span>
							</span>
							<?php } ?>
							<?php if ($show_visitor) { ?>
							<span style="background: rgba(127,127,127,0.06); border: 1px solid rgba(127,127,127,0.1); padding: 3px 10px; border-radius: 6px; display: inline-flex; align-items: center;">
								👥访客 <?php $stats = argon_get_visitor_stats(); echo number_format($stats['total_visitors']); ?>&nbsp;&nbsp;&nbsp;📊访问 <?php echo number_format($stats['total_views']); ?>
							</span>
							<?php } ?>
						</div>
<?php } ?>


						<?php if (get_option('argon_footer_show_visitorinfo', 'true') != 'false') { ?>
<div class="footer-visitor-info">
							<span class="footer-visitor-badge comment-useragent">
								<?php echo $os_icon . esc_html($os) . ($os_version !== '' ? esc_html($os_version) : ''); ?>
							</span>
							<span class="footer-visitor-badge comment-useragent">
								<?php echo $browser_icon . esc_html($browser) . ($version !== '' ? ' ' . esc_html($version) : ''); ?>
							</span>
							<span class="footer-visitor-badge">
								IP地址：<?php echo esc_html($display_ip); ?>
							</span>
							<?php if (!$footer_ip_loc_async && !empty($visitor_ip_loc) && $visitor_ip_loc !== '未知(API错误)') { ?>
							<span class="footer-visitor-badge comment-useragent">
								<i class="fa fa-map-marker text-danger" aria-hidden="true"></i> IP属地 <?php echo esc_html($visitor_ip_loc); ?>
							</span>
							<?php } elseif ($footer_ip_loc_async) { ?>
							<span id="footer-ip-loc" class="footer-visitor-badge comment-useragent" style="display: none;">
								<i class="fa fa-map-marker text-danger" aria-hidden="true"></i> IP属地 <span class="footer-ip-loc-text"></span>
							</span>
							<?php } ?>
						</div>
<?php } ?>


						<?php
						$argon_footer_show_filing = get_option('argon_footer_show_filing', 'true');
						$argon_footer_icp = get_option('argon_footer_icp', '');
						$argon_footer_gongan = get_option('argon_footer_gongan', '');
						if ($argon_footer_show_filing != 'false' && ($argon_footer_icp != '' || $argon_footer_gongan != '')) {
						?>
						<div class="footer-filing-info" style="margin-bottom: 12px; font-size: 12.5px; display: flex; flex-wrap: wrap; justify-content: center; gap: 8px;">
							<?php if ($argon_footer_icp != '') { ?>
							<span style="background: rgba(127,127,127,0.06); border: 1px solid rgba(127,127,127,0.1); padding: 3px 10px; border-radius: 6px; display: inline-flex; align-items: center;">
								🇨🇳 <a href="https://beian.miit.gov.cn/" target="_blank" style="color: inherit; text-decoration: none; margin-left: 6px;"><?php echo $argon_footer_icp; ?></a>
							</span>
							<?php } ?>
							<?php if ($argon_footer_gongan != '') { ?>
							<span style="background: rgba(127,127,127,0.06); border: 1px solid rgba(127,127,127,0.1); padding: 3px 10px; border-radius: 6px; display: inline-flex; align-items: center;">
								🛡️ <a href="http://www.beian.gov.cn/portal/recordQuery" target="_blank" style="color: inherit; text-decoration: none; margin-left: 6px;"><?php echo $argon_footer_gongan; ?></a>
							</span>
							<?php } ?>
						</div>
						<?php } ?>

						<div style="font-size: 12px; opacity: 0.8;">
							<div>Copyright &copy; 2026 <strong style="color: var(--theme-color);"><?php echo get_option('argon_footer_copyright_name', 'Yuhang'); ?></strong> . All Rights Reserved.</div>
							<div>
							Powered by <a href="https://wordpress.org" target="_blank" style="color: inherit;"><strong>WordPress</strong></a> &amp;
							Theme <a href="https://github.com/Santiago-hang/Argon-Santiago" target="_blank" style="color: inherit;"><strong>Argon-Santiago</strong></a> (Based on <a href="https://github.com/solstice23/argon-theme" target="_blank" style="color: inherit;"><strong>Argon</strong></a>)
								<?php if (get_option('argon_hide_footer_author') != 'true') { echo " By Santiago"; } ?>
							</div>
						</div>
					</footer>
				</main>
			</div>
		</div>

		<script>
			(function () {
				var siteStartStr = "<?php echo esc_js(get_option('argon_footer_buildtime', '2026-01-01T00:00:00')); ?>";
				// 后台按北京时间填写（无时区后缀），补 +08:00 让所有访客解析为同一绝对时刻
				if (/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}$/.test(siteStartStr)) {
					siteStartStr += "+08:00";
				}
				var siteStart = new Date(siteStartStr);
				function showWebRuntime() {
					var el = document.getElementById("web_runtime");
					if (!el) return;
					var now = new Date();
					var diff = now.getTime() - siteStart.getTime();
					var days = Math.floor(diff / 86400000);
					var hours = Math.floor((diff % 86400000) / 3600000);
					var mins = Math.floor((diff % 3600000) / 60000);
					var secs = Math.floor((diff % 60000) / 1000);
					function pad(n) { return n < 10 ? "0" + n : String(n); }
					el.textContent = days + " 天 " + pad(hours) + " 小时 " + pad(mins) + " 分 " + pad(secs) + " 秒";
					setTimeout(showWebRuntime, 1000);
				}
				showWebRuntime();
			})();
		</script>

		<script src="<?php echo $GLOBALS['assets_path']; ?>/argontheme.js?v<?php echo $GLOBALS['theme_version']; ?>"></script>
		<?php if (get_option('argon_math_render') == 'mathjax3') { ?>
			<script>
				window.MathJax = { tex: { inlineMath: [["$", "$"], ["\\\\(", "\\\\)"]], displayMath: [['$$','$$']], processEscapes: true, packages: {'[+]': ['noerrors']} }, options: { skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code'], ignoreHtmlClass: 'tex2jax_ignore', processHtmlClass: 'tex2jax_process' }, loader: { load: ['[tex]/noerrors'] } };
			</script>
			<script src="<?php echo get_option('argon_mathjax_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml-full.js' : get_option('argon_mathjax_cdn_url'); ?>" id="MathJax-script" async></script>
		<?php }?>
		<?php if (get_option('argon_math_render') == 'mathjax2') { ?>
			<script type="text/x-mathjax-config" id="mathjax_v2_script">
				MathJax.Hub.Config({ messageStyle: "none", tex2jax: { inlineMath: [["$", "$"], ["\\\\(", "\\\\)"]], displayMath: [['$$','$$']], processEscapes: true, skipTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code'] }, menuSettings: { zoom: "Hover", zscale: "200%" }, "HTML-CSS": { showMathMenu: "false" } });
			</script>
			<script src="<?php echo get_option('argon_mathjax_v2_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/mathjax@2.7.5/MathJax.js?config=TeX-AMS_HTML' : get_option('argon_mathjax_v2_cdn_url'); ?>"></script>
		<?php }?>
		<?php if (get_option('argon_math_render') == 'katex') { ?>
			<link rel="stylesheet" href="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>katex.min.css">
			<script src="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>katex.min.js"></script>
			<script src="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>contrib/auto-render.min.js"></script>
			<script> document.addEventListener("DOMContentLoaded", function() { renderMathInElement(document.body,{ delimiters: [ {left: "$$", right: "$$", display: true}, {left: "$", right: "$", display: false}, {left: "\\(", right: "\\)", display: false} ] }); }); </script>
		<?php }?>
		<?php if (get_option('argon_enable_code_highlight') == 'true') { ?>
			<link rel="stylesheet" href="<?php echo $GLOBALS['assets_path']; ?>/assets/vendor/highlight/styles/<?php echo get_option('argon_code_theme') == '' ? 'vs2015' : get_option('argon_code_theme'); ?>.css">
		<?php }?>

	</div>
</div>
<?php wp_enqueue_script("argonjs", $GLOBALS['assets_path'] . "/assets/js/argon.min.js", null, $GLOBALS['theme_version'], true); ?>
<?php wp_footer(); ?>
</body>
<?php echo get_option('argon_custom_html_foot'); ?>
</html>
