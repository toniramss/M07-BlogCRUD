<?php if (isset($_SESSION['mensaje'])) { ?>
    
    <div role="alert">
        <?php
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        ?>
        <button type="button" data-dimiss="alert" aria-label="Close">
            <span aria-hidden="true">$times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['error'])) { ?>

    <div role="alert">
        <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        ?>
        <button type="button" data-dimiss="alert" aria-label="Close">
            <span aria-hidden="true">$times;</span>
        </button>
    </div>
<?php } ?>