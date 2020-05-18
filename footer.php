            
        </div>

        <div class="row"><?php dynamic_sidebar (2); ?></div>
            
        <footer id="master-footer" class="clearfix">

            <div class="col-md-6 col-sm-6" id="copyright">

                <i class="fa fa-copyright fa-lg"></i>
                <?php echo of_get_option( 'options_copyright' ); ?>

            </div>

            <div class="col-md-6 col-sm-6" id="coder">

                <i class="fa fa-code fa-lg"></i>
                Powered by <a href="https://mavenium.github.io" title="طراحی انواع پرتال حرفه ای">Mavenium</a>

            </div>

        </footer>
        
    </section>
    <!-- /Master Sec -->

    <?php wp_footer(); ?>

</body>
</html>