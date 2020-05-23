        </main>
    </section>

    <!-- Notifications -->
    <div class="toast" id="messages" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position:absolute; bottom:5px;right:5px;">
        <div class="toast-header bg-light">
            <strong class="mr-auto">Information</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Il y a un nouveau message dans le chat
        </div>
    </div>
    <div class="toast" id="private" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position:absolute; bottom:5px;right:5px;">
        <div class="toast-header bg-light">
            <strong class="mr-auto">Information</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Vous avez un nouveau message privé
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script>
        let user = <?= (isset($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0 ?>
    </script>
    <script type="text/javascript" src="js/scripts.js"></script>

</body>

</html>