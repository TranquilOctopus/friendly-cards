<div class="card">
    <div class="name">
        <h3 class="pull-left">{{$card->name}}</h3>
    </div>

    <div class="image">
        <img src="https://imageserver.eveonline.com/Character/{{$card->character_id}}_256.jpg" class="img-rounded">
        <div class="corp-img">
            <img src="https://imageserver.eveonline.com/Corporation/{{$card->corporation_id}}_64.png"
                 class="img-rounded">
        </div>
        @if($card->rarity == 3)
            <div class="rare"></div>
        @endif

        <?php
        $points = explode('|', $card->attack);
        ?>
        <div class="points">
            <div class="top">{{$points[0]}}</div>
            <div class="left">{{$points[1]}}</div>
            <div class="right">{{$points[2]}}</div>
            <div class="bottom">{{$points[3]}}</div>
        </div>

    </div>

    <div class="desc well">
        {!! nl2br($card->text) !!}
    </div>

    <div class="footer">
        <span class="text-muted pull-left">Value: {{$card->value}}</span>

        @if($card->rarity == 1)
            <span class="glyphicon glyphicon-th-large text-center rarity" aria-hidden="true"></span>
        @elseif($card->rarity == 2)
            <span class="glyphicon glyphicon-star-empty text-center rarity" aria-hidden="true"></span>
        @elseif($card->rarity == 3)
            <span class="glyphicon glyphicon-star text-center rarity" aria-hidden="true"></span>
        @endif


        <span class="pull-right text-muted">#{{$card->id}}</span>
    </div>

</div>
