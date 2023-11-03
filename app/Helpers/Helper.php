<?php
function formatRupiah($nominal)
{
    return number_format($nominal, 0, ',', '.');
}