<div class="navbar navbar-primary navbar-fixed-top" data-spy = "affix">
    <ul class="ram-nav list-inline list-unstyled text-center">
        <li class = "menu">
            <a href="{!! url('/#fresher-king-selection') !!}">
                <span class="fas fa-crown icon king-icon"></span>
                <span class="icon-text">Fresher Kings Selections</span>
            </a>
        </li>
        <li class = "menu">
            <a href="{!! url('/fresher-queen#fresher-queen-selection') !!}">
                <span class="fas fa-crown icon queen-icon"></span>
                <span class="icon-text">Fresher Queens Selections</span>
            </a>
        </li>
        <li class = "menu">
            <a href="{!! url('/whole-king#whole-king-selection') !!}">
                <img src="{!! asset('svg/king_crown.svg') !!}" class = "icon" alt="King Crown" width = "18px" height = "20px">
                <span class="icon-text">People Choice (Male)</span>
            </a>
        </li>
        <li class = "menu">
        <a href="{!! url('/whole-queen#whole-queen-selection') !!}">
             <img src="{!! asset('svg/king_crown.svg') !!}" class = "icon" alt="Qeen Crown" width = "18px" height = "20px">
            <span class="icon-text">People Choice (Female)</span>
        </a>
    </li>
    </ul>
</div>

<script>

    document.getElementsByClassName('ram-nav')[0].children[<?= $data['item'] - 1 ?>].className = 'active';

</script>
