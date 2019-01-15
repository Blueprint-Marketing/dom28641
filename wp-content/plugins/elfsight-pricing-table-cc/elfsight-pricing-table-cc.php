<?php
/*
Plugin Name: Elfsight Pricing Table CC | Shared By Themes24x7.com
Description: Help your customers make a purchase with a clear and graphic pricing
Plugin URI: https://elfsight.com/pricing-table-plugin/wordpress/?utm_source=markets&utm_medium=codecanyon&utm_campaign=pricing-table&utm_content=plugin-site
Version: 1.0.0
Author: Elfsight
Author URI: https://elfsight.com/?utm_source=markets&utm_medium=codecanyon&utm_campaign=pricing-table&utm_content=plugins-list
*/

if (!defined('ABSPATH')) exit;


require_once('core/elfsight-plugin.php');

new ElfsightPlugin(array(
        'name' => 'Pricing Table',
        'description' => 'Help your customers make a purchase with a clear and graphic pricing.',
        'slug' => 'elfsight-pricing-table',
        'version' => '1.0.0',
        'text_domain' => 'elfsight-pricing-table',
        'editor_settings' => array(
            'tabs' => array(
                array(
                    'id' => 'layout',
                    'name' => 'Layout',
                    'active' => true,
                ),
                array(
                    'id' => 'columns',
                    'name' => 'Columns',
                ),
            ),
            'properties' => array(
                array(
                    'id' => 'layout',
                    'name' => 'Layout',
                    'tab' => 'layout',
                    'type' => 'select-visual',
                    'select' => array(
                        'options' => array(
                            array(
                                'value' => 'grid',
                                'name' => 'Grid',
                                'img' => 'data:image/png;base64,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',
                            ),
                            array(
                                'value' => 'columns',
                                'name' => 'Columns',
                                'img' => 'data:image/png;base64,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',
                            ),
                            array(
                                'value' => 'table',
                                'name' => 'Table',
                                'img' => 'data:image/png;base64,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',
                            ),
                        ),
                    ),
                    'defaultValue' => 'grid',
                    'description' => 'Select one of the three predefined layouts. Columns features separate columns. Grid groups the columns together in a single block. Table displays a table structure complete with a table head.',
                ),
                array(
                    'id' => 'skin',
                    'name' => 'Skin',
                    'tab' => 'layout',
                    'type' => 'select-visual',
                    'select' => array(
                        'options' => array(
                            array(
                                'value' => 'default',
                                'name' => 'Default',
                                'img' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAABdCAYAAADjaOUDAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABT5JREFUeNrsXF1oFFcUPjOJa6LV9a9pCkKD1j8QWo2KIL74JEhb/40xrUJplArdCqUPioi1L8VSTaEFtQ+1xtS/RKL46kseaq0hFgpN/SkpCGpqNKtNUtd11+/YM+ndza47Oz+7O3APHO7OnTsz57v3nu+emb33GpQmv1+7OQ3JGuhS6GxoFXQstJxcSDxh0N6uV+hS75icZWvGxejLRbfj4dDTARz2QruhHdDWOTOn/6mWNRTDJyD5Gtqg5nspDkAQQKjZSWgz9CMA6R8GIMYzwrlSsBN6Cvoz9C9ov1cgOu9VhnZ3Vh99kjCW5yo7ykxe+3zBnU/nTx6ahcP10Fo59Rv3EAZhAfgBybvQf6GNOHGMfJSpTckQkjPQtzKdN6SqFWOX3YoYf8NOtvEwtAJ6DHa+Z0ifvyHXNSDzOBVAsoE4De+rCaM229Hx+zKC2CTdiDG+borDsvFXC2U8C4yJIVkLPa/mV4Aqql8iOrkaDDJ5OJu79kWAfllsvCo2rzGFbVhaqMCSCcSWc0R/oOYnVWYHodi61BSqZPmFiiDpIPqGiOrOgjmi2UF09VVel+PZpvA8CdtQKYC4N0i0rjU7iF1Xqr+Ixsr4d5UpgxR5SZVegLj9T3YQoOCZn1x+lQBirKmMsEkqsuQC0bKKKFT2X9meRyECiHJX4QEojalwP/R9pSXtyhMODaDbwCxRFQQcda1FsRaI4yuJRsP4hFLNDMJ0WWn7eFh3YPzzgRZaB/3eTkssA/MvOcrhSGpZtwDqPeg576Alx9kdJ9LFpBIWOyDcAvBi8GuHDzxyCsItgN0Sgg84uJad+AQPvm5agoM5y68nWjG2Q0YK5/ke8RDPS7gNAD0DUChhEHhPaLfeJ0wKmHB32ld7Z/PiqkEKJACW2ilDsT3z7hKDCCQAlnIzSQwisAAsEIEGEFgf0AA0AC8d2cFIuBfJTh7SMahslDDiM8krc2nPj4gG6v1uga0CvA5gJkleowfGs2xEZYz3G8AhaJwjSbTAfcnjz31PPQDALfAwnwscBXOoeQPGJ9Oi0dFIKl0YH8PzB21Gvvwx+oEjH5CAasQXDDz8MZLHmoU0C2kW0iykWUizkGYhzUKahTQLaRbSLKRZSLNQQEQD0AA0AA1AA9AANIBAvQ/kCLJeNAWNZ6e0cTiuTjErKQD0/xS0TMJTzDZAOWpdVapdqMFGmYxTzLQTeyTNNsq8cIpZsX2Ap6BV5HLikmUh1CzPbYuwZpiClvcUs2K0gAomGkQf0COxDiXsyNSmZL046zwZYd0IsxMv+/rqVsQ47XsLwPhvkPBCnEUeGG+FGIuhp3DvA74CwAN4CdSHPvaIj/GM1X52oUh6Rs0Eordn8AzC/G7En/Yu9hD9enfEqR0y4HkLADVjSp9PkSMrUhbo5CWNuNsbR4hiqZ+FF2gWyiRgiARaoQs/F6r5H1wgWjcHgU+e7sy1fuHGiNpnueKnDzSlR5w9/XgF+8nTSj3gWxdCKzB9futjjziIZ7T56gN4wHYkTKeXZRByK3yPS9D1uPcOJz4Ql9TIAwSvnWnhf2qQht1Yj3s5WXRh2RpnwwfEiOG/bfJ4ONN5MVZ9WJU2wF2oVw5eCxB71kjaywC65WBhgABYa+u7GUCHHNQHCIBlawcDaJXQ5E1Zr17SAht5d4P5YnOrKRtNWIPTd7JzQKkary4ebWbb7ewrgZiR+AU9iguSBTLUouewkAv75wbFT1P3lVBA+Lqzhwdi7ewRgfEPKJOhADIdCb9UeLq3igOJyxil7q3SBsNvqoWeCTAAzMdo8rL/cMgAAAAASUVORK5CYII=',
                            ),
                            array(
                                'value' => 'skin1',
                                'name' => 'Skin 1',
                                'img' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAABdCAYAAADjaOUDAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABLJJREFUeNrsXEtIFVEYPne0VKw0I2kRJFmmEPQ0gnDjKogevs3sAZFFQeamRdCiWkWQGRSULSofmaZh4daNi95kEGSmYRBElvkoLc2076d/bO71ep25M3PvDJwfPo5z7jz+78z5v/PPeM54hI8trZhcjiIHyABSgUQgFogUobVxYBjoBTqANqDxY6nnvXYnj8bxeBSXgWJtvcNsEqgGjoPIwBQBdp4YruYdXwD1wBPgAzBgoRNzgVvAVh37dgIngVVAPrCB619TDyESKoHbKPYCv4AS/FBlZzPiekTiHrDd3+8ebmqNs5nw6QuOIx+vA9FAFer2ebjPd/FxxaisCUVfmIlEA6IvKQ6t2YyO3+eXxB7uRsRxhcIBS863h8p5MlxrDEUu8FBbHw2pWDJPiLvZUJBFU9XUtVvh/GL2sZ19zlFYbchqQx2R/kgceCDEW7R8QszMJDS+ZigslWTPwiErviT6fgpReB/KMTgzCeAdb6cqrPOC1UY4gcTXESHyGgOSOM9/Jyo8SAmLpdI0iU8/ApJI4TJW0Yywk+EepWYjUZuFQSTC65DISAuk8AJwUHMn9dpvSg2AI3B8UEsC581VJVYlUbNLiCg4P+HTzIrJRjtHw3oQzpPNAQqBm3ruRCaUfwvG7/EJawkUWdBzdqLF5+sdJ3xNEQ42PSTMErBi8GuGo9+DJWGWwGlOwYeDOJaCuI4GXzN3gpI5Na4Xqjl2kIoUZ/A5YgjXmzCbAFpGIFTGJJrV5wlFuMy4O+13hQoFsDG3ExCSgCQgCUgCzjDDDzRvOrvPoDhFQ3paSvJurjvLdREm/bmDcxbZfQcOM/FCOJ7AdSUWOE+2G+dcYDeBa+Lfm+M6tNY3rqPXfX8sIEB3YMjIAUElc2glDy406VMXhSLGTHqAc47oTOjoZXR/UDFA5us8142iGJUqJFVIqpBUIalCUoWkCkkVkiokVUiqkFQhqUJShVxikoAkIAlIApKAJCAJuOp5YJYkK9AUNJqd0kTpuHaKmaMIiP9T0PwZTTErAChrzXJqFyrWsY/fKWYyiC2yah37BJxiFu4YoClo0bMFsWNViCcjlRL8TEEzPMUsHHdAS2bQjTEgR2KZSuhMGYo4WNfxCGvGSJ1o2ddFxE2D7XcAzl9BQQtxNlngvJpibAbqce5yWwnwEqijNvaIE7hGtp1dqNS3IileiB0rcSKD95Je7bX2CPHq87SfynjAs5YAWkbhPu9lldu81rYYshKcbU2lEGPer4U3ShWaYWSdwF14iT/TtfWHWoTIS0PiYzCcqdVbuqa1PtlzO2Ogwjfj7BnAI9gjSxu13LYuxOsYr9rYIy7hGk22xgAucAwFyelTHoTMGp3jMZCPc5cFEwPjXHoMkKC1M7WICTomzmTWGsyiC9XXcXJ8mJ2Y+reNgYuTnIdj1YfaaMPUhXp5Y5mL1DOJy14i0MEb6S4ioK6t7yACbbxR5CICqq9tRKCRU5O1nKw52uAjfd1gPfvcqPCHJtTB6QZ/OcCpzmsXj1aT73q+K4GcUdAD+iCrTigcVeU5jsWF4rNAE6fe35XQkHDLlz1K4Xy/8OcoiCSjoIcKJ35bpQmOd2t3+ivAAKaXKsrNRc1yAAAAAElFTkSuQmCC',
                            ),
                            array(
                                'value' => 'skin2',
                                'name' => 'Skin 2',
                                'img' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAABgCAYAAABbjPFwAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABNZJREFUeNrsXE1oFVcU/maMtvGn0cQKQkGr1UYR/BcXdemmxYiG/Bh10YgKCj6zKIjoQl0KxhSUqsV2Ya1GE6ygCwNustAESxAKRklihEA1EE3UKMZnnt/x3dHJvMT35s1MMgP3wOFkZu7MPd+953z3J/PGgEO+qUnMoSmmrqEWUmdQJ1Fz4EHGjwNO/Qis/TZ92fs9QFk94j2v0c/DbmortZFa1xUzOuxlDZvjU2l+pW6xn/dTsgABgrBLgnqOuodAej8CUM4LwkUIWNKBSNhabwQQIv9JhAgIU52oGQ3nRd6+A3ZeBxoepl4rpbOrzjJeepLH3xcAFzcCBbkpRRepaIGhYr4tqLBx0xNFtUDLYyA/N+l4YUHacPrOVAk7qs6P1BN/rEu2+tPXSYfT9IT4XGwqthkTcYIoUC3vAsQaU1ElwgTiwgZgVl5GIApNxfMIE4jpE4FLxRmBmGGqQQphAzFzckYgJpleR9gxBpEjNJrwQoUHfgDKFwITx7u7Nz4IXCd577sJvBj4PMX+/xIoqQMe9QFfM7yafk6WETG9tNgvq4HKxe6dF8lhzUXzgeq1mffEvHwgl3UZNtL31APNlcmHexGpfOFvwMuB7OZOJkIsn5t2+ALgyn3vTt5oH771MwXhCcDR28DZu8Crt+7vlSS++gCoavDWE55ywC5TJgxNrnQirT6YcM96zpzwDcBYzWJNREyc4RQ5AE4QkQshZziZiLBIT0QaQGRzQAMIkxj3HrRbLDRtwfy5vVFwmj7LRtwzHUIagAagAWgAnsX1phZnr4do9lMvd8WMTYqXD6tz4zz68zfHooqge2CnAl5OMPnq3A4fnBfZxMb4KmgAp2RNTr3AHniqzp2mvvMBgPTA88CnEmx5g84nHMP7FzS5HpwfYP2v3E4lstrYdTovwsrf0LzRLKRZSLOQZiHNQpqFNAtpFtIspFlIs5BmIc1CmoUiIhqABqABaAARmwulGWAm0BylbkPq+6jyWlS9TEU4ZvSFEgDlCHXPCNfk3cYyqozYG8IaQlsyKLOePTVF50BAAM5lUOYf5sCLsObAQeqX6ZI4tCzElpU3QGOijPM8DP1lyHNeHww1jTrA9EUxB/RIrKcSGa6JK1SyLlUjrBcRdvqXeoxL1UuB9wCdP0HzF3WVD85bU4zV1Fo+uzpQAKxgM82uACNiL+vYGGQIxZwnZk8FiuYlf1LiRmRb42YncPdJyqUqNeD5C4AtY6qYHyJnfvr0m0e3soNPW3wGGBi6JbZCs9BwQoYYZC+08M+V9vPbrwElCzjxcZnO0urX2lJaX+ROkDlQ45xxdvZyCXbL10atDiyE2AtCnycDjIjjrKM+0BxgBbtphE6b1SDkVeQZt6mlfHZVNjkQV9ZwAeI8zXnZpabN8+K99eN+l2L5GhfH+5UTH7esXVQudD4W71tbjdYvIdStDmZFiD1nK9stAFrVwcoIAViubKsAaFQHFRECYPnaKADq1NRkCdexm8PuOX0spVmmfK4zuXbtsA1Ov7PA1hA7X07zp7WFI74b6oLz0ySywKilNslgS5UFeh9vSIySoxY95ylykfwss+Xph0+TyD8lDdtNgX8cxgexPg4To/PPMJyjBDKXRhYVvn6eJwuJqzHK/nmeejrebi/0XoABANT6TBmDnLSQAAAAAElFTkSuQmCC',
                            ),
                            array(
                                'value' => 'skin3',
                                'name' => 'Skin 3',
                                'img' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAABfCAYAAACuoEQIAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABDxJREFUeNrsXF1IFFEU/nY0NSsSTCMIsgyNWrSooCghgoqKrJQo0IJKiUiUqCiqlx566knfyooogyLsj/6DqHwJeijFaM0sg8AyDCvNf7dzmCl313F3Z+7MNgP3g8PiZYY53z3nfufe8c71IATTK/2z6KeQLI9sDlk62QSyeAhgXBxweh2wambka5s6gK3XMdjRg276s53MR1ZHVvu5wvMh8FpPgOMp9FNFVhzYbiVMkACRCISfrIasnIh0/iOgOc8MvbAZFpBgNHKGMAlFa6iMhfOMgSFgzz3g8cexr/Frv9mpwNUCIHX8qEu8WrbAo+X8e7vSxmgkttQCrT+ASxtpAKZGTKfZijZgY+p8uEj0DgJfulSHfR1hI8E+Fyqa2vwX6JG4kK86/L0nKhJ5iiaVcAoJdvDKZmDG5KhIzFE0nYeTSExJBq4VRkUiXdGKFJxGYtrEqEhMYBXyw0EIVae2LlWZPpEypVFkXuwEEuJG1EmIAD/s+HJg21wgeZyxeweHgXsk3keeAL/6I5Mougn0UZSebac5jRIgRSIEji4D9i4U6/GHLUDJXfMVWxF5+KZs8ZRZnQlMTDBXsYUJOGHaIUTgZpO4k48ohbr6zZMQInDqBXC+Hvg9YPxeHsS33wH7H4tFwjIZnUR57DEwo+JeHzb4ZL2B7bg6YJSEApchNJ1cRyCUhOtSKDSdFLgYHAlXE3DtGJAEJAELYfh954ElQNkidTGy74HadpDbFgNxgi9nbtHcqOyBzREo9qorovwsICVJbSvyijvP2JilvzawlEBN48hMsrNXbbtMbUMWlEOOQLiptR5MVWLu7NCbeKGdJPACnotSz2AMxgB0nGf0D6kmVUiqkFQhqUJShaQKSRWSKiRVSKqQVCGpQlKFpAq5BJKAJCAJSAKSgCQgCUgCckVmEcJtAuQ1xH1axR3W2eTnGAKHaGm5K3eMB1GsN2Sp6wa9TX6OSKGCKDYxj7XJTw5iK3DdF/maSJv8/usY4E2AifGRB7GVsG3DU+gmQDOb/GIegUBYKZVyEEsCTptK8K713fMBb1rwXn4zYHVqaAeqXwF3mmOgQidXADty7OnNs6+BE89tTKHN2fY5zyihqK7NtDGFOG1C0doJ3G5WU8FQ6MlWZgC5U4PbSxdQwWuxgYBCT5yXNrq99O7I10VGcYbyvr505KMeRs5UqUL64GnAm2+jQ169Hrj2Fug2+BEE9/r62cG9z2j4auMYOEcqUbUmuC0jhRYyS63rUZZT21LoRhNwscG+dGAZNTKATRWyY0+Bl23OKmQDZisyS+GkRDECP/vE+LPjfHLAZDN3+8UdEEU3J0C7i1W0nQn4XEzAxwTqXEygjgnUQv9fv04H+1yraEd9XHIhgRr2/a+KV0A9LcMtYF/L/1Vi7ZySPC0SfoenDfuYF3S2SiDsOt3GTJHSalTY023+CDAA43//DHPXCMcAAAAASUVORK5CYII=',
                            ),
                            array(
                                'value' => 'skin4',
                                'name' => 'Skin 4',
                                'img' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAABhCAYAAACQ0CLVAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABXhJREFUeNrsW1tsFFUY/mb20nbbpsXeDQmNlLZqA9ZShEQS0weFEFTAC5GKF6gx0eiDiA+IguiD4It9UzQqt4gIpFWk8aEx+iBSm9amBui2CpFYaNnaUtotexv/vzvb7C5b2t2ZWXb0fMmf2T07s+f7zvnP95/ZaSVE4UxP3x10WEexnKKSopAik8IKDfAFJOzsKMKpAceM55Zme/DBkn5fjt0/Rm8HKM5S/ERx9M7y+X+EnyuFEc+lQyNFfXi7nkhABEhEeLNCcYDiFRIyPCVAJc8Kq9QT2ym+oviF4gLFsF4i2q9k2Le3F3/hDUgrYn0uqSwZNlnpeXfxpa335rkr6O0TFDXqR92cISwiJGAfHZ6mmKB4gT7YDwMx90PFToevKVaHtx+hxC3NISJNlDOuqWYmW3fxVWmQeDLHjygyKPYTz42SmvO9qvh6ajyIJCCWiGYa4+piYMgNPHlsWhEb1DTiiSqT1QXL5DuTRZ5BZDx0eIzim1Dbc/TqHJG+jcb38FpykLyp0zm1W0l0gcqxU+W8TlbdhnEISUa0CJc68jOJCOO6XFatktGGW4DpRPw5PL2IDleGU31fKas+D9VtkEoiLozEFrHt1+L3RzwWfl0oq0UKelqlHiL6rwGPH40tgiy4fMvpEpCITDmswiq4xYhHxPlRO0iElW00RHxOqLrNFnQtW+Eeik1hMzlbeHlrQPEi9TtyM4styQrWiHlUIwbHgfs+o4vVAi1rHLRdXNYTID9ZaCnWU3w+25lwDgFukq2E5YrWGfiLB0zjIHD/OdT36GyKnRSV6zJSGLGKXfRC1SpAj+LXFGv0byZCTwHb1S34WALX8iL+kuLZRGZClzUQtR5y4ryPuEr9BbRuAHUTkCywCLpPaArdT8gwGTiddtVcemZp4ThMKYBRk+/2vF19GSzClAIYVlkBizCtgJAIUwsw7Rr4TwmQyFcVMQNCgBAgBAgB/1sBcT91eW0p8PJi4Lte4KWWYNsWbqsFLBofizT10Pe0GDwD9VW8iQIeLgdy04NtG6q0k2c8Qt+ZZTdYwIFuflQENNNoDU8E2w5Sm1+Hes4zcM2ThK2EFOPnDbsFSNfwGJB/aXP7krAGgNg/onr8wRAuJFxIuJBwIeFCwoWECwkXEi4kXEi4kHAh4ULChUwCIUAIEAKEACFA7EZ1g422E2/eD6y/C3DYIj/j/dNJ2sG+0QqMelJUwOu0rX5+0TQd0VyvLg/umTafSNEUWls58zkPzo9/yywW8Wxx7OzM53zfF/+eP2lrYM8pIM068yLWE4b9tUo25bkUdpvJox4woCerUbmpp1WKRSwEpNpW4tEKYNM9QFVBsMJqAbtT1wCwtwP41pkEF3rvAWDjQmNG85NOYOePBqbQmgrjyDM206yunG9gCnHaROP8MNDsDKZCXFNPUVcKLCqKbG+opoLXZ4AAmXq8u+DG9oYTEf+0GRc+prz/rSG4Qw1hYZFwodjgbcDvgzdO+d5VwJEzwJg3vo551FeVRY4+o+uygWvgU3KJxoci20pz6UZmmX4jynZqWAodPwfs6zIuHdhG41nACRWybT8Abf0pVMhKGwOKT0ns8QpflZ2mTcDV64lfa5EUWO0WRfH5pIQUKBoJaEUacZdz7H4vTArmLuen+YfMKoC5y/npvnbTCiDuconDt1uWzEeeOTP3SeprDo052wYdZWYSUFsw3nv8qcwFky5eNWeibl6WZ8Is5Jkrcw5Z+SR2tLjmdv+T3to2mLHAr6RmTrHv1xa4nUx+x4q8ixECQnjrpGvZ3+O2rQNu65Ir1615Y17ZNuGX5HG/jGT9vxNXJYclgHSLEsi0Bbz5aT5XYYbv9O0O7+53Vub9HH7uvwIMAKTRc7Gme/yuAAAAAElFTkSuQmCC',
                            ),
                        ),
                    ),
                    'defaultValue' => 'default',
                    'description' => 'Skin defines the column elements to be colored in main color for each column. It\'s the fastest way to color the columns. Also there are color options available for each element to create a unique coloring.',
                ),
                array(
                    'id' => 'elements',
                    'name' => 'Elements',
                    'tab' => 'layout',
                    'type' => 'complex',
                    'complex' => array(
                        'properties' => array(
                            array(
                                'id' => 'type',
                                'name' => 'Type',
                                'type' => 'select',
                                'select' => array(
                                    'options' => array(
                                        array(
                                            'value' => 'none',
                                            'name' => 'None',
                                        ),
                                        array(
                                            'value' => 'picture',
                                            'name' => 'Picture',
                                        ),
                                        array(
                                            'value' => 'title',
                                            'name' => 'Title',
                                        ),
                                        array(
                                            'value' => 'features',
                                            'name' => 'Features',
                                        ),
                                        array(
                                            'value' => 'price',
                                            'name' => 'Price',
                                        ),
                                        array(
                                            'value' => 'button',
                                            'name' => 'Button',
                                        ),
                                    ),
                                ),
                                'defaultValue' => 'none',
                                'description' => 'Select element type from the list.',
                            ),
                        ),
                    ),
                    'defaultValue' => array(
                        array(
                            'type' => 'picture',
                        ),
                        array(
                            'type' => 'title',
                        ),
                        array(
                            'type' => 'features',
                        ),
                        array(
                            'type' => 'price',
                        ),
                        array(
                            'type' => 'button',
                        ),
                    ),
                    'description' => 'Arrange the elements to be displayed for each columns, and their order.',
                ),
                array(
                    'id' => 'head',
                    'name' => 'Head Column',
                    'tab' => 'columns',
                    'type' => 'subgroup',
                    'visible' => false,
                    'subgroup' => array(
                        'properties' => array(
                            array(
                                'id' => 'headTitle',
                                'name' => 'Title',
                                'type' => 'text',
                                'defaultValue' => 'Plan name',
                                'allowEmpty' => true,
                                'description' => 'Set the head column\'s title. The title will be displayed on the level with the titles of the rest of the columns.',
                            ),
                            array(
                                'id' => 'headFeatures',
                                'name' => 'Features',
                                'type' => 'complex',
                                'complex' => array(
                                    'properties' => array(
                                        array(
                                            'id' => 'text',
                                            'name' => 'Text',
                                            'type' => 'textarea',
                                            'defaultValue' => '',
                                            'description' => 'Enter the feature name.',
                                        ),
                                        array(
                                            'id' => 'hint',
                                            'name' => 'Hint',
                                            'type' => 'textarea',
                                            'defaultValue' => '',
                                            'description' => 'Add a hint to provide your customers with additional information or provide a more detailed description of the feature. Hover on the question mark next to the feature name to display the hint.',
                                        ),
                                    ),
                                ),
                                'defaultValue' => array(
                                    array(
                                        'text' => 'Feature 1',
                                    ),
                                    array(
                                        'text' => 'Feature 2',
                                    ),
                                ),
                                'description' => 'Set the names for the features to be displayed in the comparison table. Each feature name is displayed on the level with the corresponding feature in the table.',
                            ),
                            array(
                                'id' => 'headTextColor',
                                'name' => 'Text Color',
                                'type' => 'color',
                                'defaultValue' => 'rgb(23, 25, 26)',
                                'allowEmpty' => true,
                                'description' => 'Set the head column\'s text color.',
                            ),
                            array(
                                'id' => 'headBackgroundColor',
                                'name' => 'Background Color',
                                'type' => 'color',
                                'defaultValue' => 'rgb(247, 247, 247)',
                                'allowEmpty' => true,
                                'description' => 'Set the head column\'s background color.',
                            ),
                        ),
                    ),
                ),
                array(
                    'id' => 'columns',
                    'name' => 'Columns',
                    'tab' => 'columns',
                    'type' => 'complex',
                    'nameProperty' => 'title',
                    'complex' => array(
                        'properties' => array(
                            array(
                                'id' => 'generalGroup',
                                'name' => 'General',
                                'type' => 'subgroup',
                                'subgroup' => array(
                                    'properties' => array(
                                        array(
                                            'id' => 'isFeatured',
                                            'name' => 'Featured column',
                                            'type' => 'toggle',
                                            'defaultValue' => false,
                                            'description' => 'Use this option to highlight a column against the other ones. Hint: use it to highlight your most profitable plan.',
                                        ),
                                        array(
                                            'id' => 'mainColor',
                                            'name' => 'Main skin color',
                                            'type' => 'color',
                                            'defaultValue' => 'rgb(28, 145, 255)',
                                            'description' => 'Set main skin color to color this column\'s elements according to the selected skin.',
                                        ),
                                        array(
                                            'id' => 'styleColumnBackgroundColor',
                                            'name' => 'Background Color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'allowEmpty' => true,
                                            'description' => 'Set the column\'s background color.',
                                        ),
                                        array(
                                            'id' => 'styleColumnBorderRadius',
                                            'name' => 'Border Radius (px)',
                                            'type' => 'select-inline',
                                            'selectInline' => array(
                                                'options' => array(
                                                    array(
                                                        'value' => 0,
                                                        'name' => '0',
                                                    ),
                                                    array(
                                                        'value' => 16,
                                                        'name' => '16',
                                                    ),
                                                ),
                                            ),
                                            'defaultValue' => 16,
                                            'description' => 'Choose one of the predefined column\'s border radiuses.',
                                        ),
                                        array(
                                            'id' => 'styleColumnBorderWidth',
                                            'name' => 'Border Width (px)',
                                            'type' => 'select-inline',
                                            'selectInline' => array(
                                                'options' => array(
                                                    array(
                                                        'value' => 0,
                                                        'name' => '0',
                                                    ),
                                                    array(
                                                        'value' => 1,
                                                        'name' => '1',
                                                    ),
                                                    array(
                                                        'value' => 2,
                                                        'name' => '2',
                                                    ),
                                                    array(
                                                        'value' => 3,
                                                        'name' => '3',
                                                    ),
                                                ),
                                            ),
                                            'defaultValue' => 1,
                                            'description' => 'Use one of the predefined options to set a column\'s border width.',
                                        ),
                                        array(
                                            'id' => 'styleColumnBorderColor',
                                            'name' => 'Border Color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'allowEmpty' => true,
                                            'description' => 'Set a column\'s border color. This is applicable only in case when the border width is over 0.',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'id' => 'pictureGroup',
                                'name' => 'Picture',
                                'type' => 'subgroup',
                                'subgroup' => array(
                                    'properties' => array(
                                        array(
                                            'id' => 'picture',
                                            'name' => 'Picture Url (3:2)',
                                            'type' => 'text',
                                            'defaultValue' => '',
                                            'description' => 'Paste the URL of the picture you want to display on your column. The picture\'s aspect ratio should be 3:2.',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'id' => 'titleGroup',
                                'name' => 'Title',
                                'type' => 'subgroup',
                                'subgroup' => array(
                                    'properties' => array(
                                        array(
                                            'id' => 'title',
                                            'name' => 'Title',
                                            'type' => 'text',
                                            'defaultValue' => 'Title',
                                            'allowEmpty' => true,
                                            'description' => 'Set the columns title. As a rule, it\'s the name of your plan.',
                                        ),
                                        array(
                                            'id' => 'titleCaption',
                                            'name' => 'Caption',
                                            'type' => 'text',
                                            'defaultValue' => 'Title caption',
                                            'allowEmpty' => true,
                                            'description' => 'Set a short additional description as the title\'s caption. For example, you can say here who will profit the most from this plan.',
                                        ),
                                        array(
                                            'id' => 'titleTextColor',
                                            'name' => 'Title color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the title\'s text color.',
                                        ),
                                        array(
                                            'id' => 'titleCaptionColor',
                                            'name' => 'Caption color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the caption\'s text color.',
                                        ),
                                        array(
                                            'id' => 'titleBackgroundColor',
                                            'name' => 'Background color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the title area background color.',
                                        ),
                                        array(
                                            'id' => 'titleFontSize',
                                            'name' => 'Font size (px)',
                                            'type' => 'number',
                                            'defaultValue' => 24,
                                            'description' => 'Set the title font size in pixels.',
                                        ),
                                        array(
                                            'id' => 'titleFontWeight',
                                            'name' => 'Font weight',
                                            'type' => 'select-inline',
                                            'selectInline' => array(
                                                'options' => array(
                                                    array(
                                                        'value' => 400,
                                                        'name' => 'Regular',
                                                    ),
                                                    array(
                                                        'value' => 600,
                                                        'name' => 'Bold',
                                                    ),
                                                ),
                                            ),
                                            'defaultValue' => 400,
                                            'description' => 'Select the title font weight.',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'id' => 'featuresGroup',
                                'name' => 'Features',
                                'type' => 'subgroup',
                                'subgroup' => array(
                                    'properties' => array(
                                        array(
                                            'id' => 'features',
                                            'name' => 'Features',
                                            'type' => 'complex',
                                            'complex' => array(
                                                'properties' => array(
                                                    array(
                                                        'id' => 'text',
                                                        'name' => 'Text',
                                                        'type' => 'textarea',
                                                        'defaultValue' => '',
                                                        'description' => 'Enter the feature description.',
                                                    ),
                                                    array(
                                                        'id' => 'icon',
                                                        'name' => 'Icon',
                                                        'type' => 'select',
                                                        'select' => array(
                                                            'options' => array(
                                                                array(
                                                                    'value' => 'none',
                                                                    'name' => 'None',
                                                                ),
                                                                array(
                                                                    'value' => 'bulb',
                                                                    'name' => 'Bulb',
                                                                ),
                                                                array(
                                                                    'value' => 'check',
                                                                    'name' => 'Check',
                                                                ),
                                                                array(
                                                                    'value' => 'checkMarkCircle',
                                                                    'name' => 'Check Mark in the Circle',
                                                                ),
                                                                array(
                                                                    'value' => 'cross',
                                                                    'name' => 'Cross',
                                                                ),
                                                                array(
                                                                    'value' => 'crossCircle',
                                                                    'name' => 'Cross in the Circle',
                                                                ),
                                                                array(
                                                                    'value' => 'dash',
                                                                    'name' => 'Dash',
                                                                ),
                                                                array(
                                                                    'value' => 'dashCircle',
                                                                    'name' => 'Dash in the Circle',
                                                                ),
                                                                array(
                                                                    'value' => 'dot',
                                                                    'name' => 'Dot',
                                                                ),
                                                                array(
                                                                    'value' => 'info',
                                                                    'name' => 'Info',
                                                                ),
                                                                10 => array(
                                                                    'value' => 'like',
                                                                    'name' => 'Like',
                                                                ),
                                                                11 => array(
                                                                    'value' => 'love',
                                                                    'name' => 'Love',
                                                                ),
                                                                12 => array(
                                                                    'value' => 'plus',
                                                                    'name' => 'Plus',
                                                                ),
                                                                13 => array(
                                                                    'value' => 'plusCircle',
                                                                    'name' => 'Plus in the Circle',
                                                                ),
                                                                14 => array(
                                                                    'value' => 'star',
                                                                    'name' => 'Star',
                                                                ),
                                                                15 => array(
                                                                    'value' => 'stop',
                                                                    'name' => 'Stop',
                                                                ),
                                                            ),
                                                        ),
                                                        'defaultValue' => 'none',
                                                        'description' => 'Select feature icon from the list',
                                                    ),
                                                    array(
                                                        'id' => 'hint',
                                                        'name' => 'Hint',
                                                        'type' => 'textarea',
                                                        'defaultValue' => '',
                                                        'description' => 'Add a hint to provide your customers with additional information or provide a more detailed description of the feature. Hover on the question mark next to the feature text to display the hint.',
                                                    ),
                                                ),
                                            ),
                                            'defaultValue' => array(
                                            ),
                                            'description' => 'The list of features. You can list any feature or item, characteristic of the offer.',
                                        ),
                                        array(
                                            'id' => 'featuresStyle',
                                            'name' => 'Style',
                                            'type' => 'select',
                                            'select' => array(
                                                'options' => array(
                                                    array(
                                                        'value' => 'clean',
                                                        'name' => 'Clean',
                                                    ),
                                                    array(
                                                        'value' => 'divided',
                                                        'name' => 'Divided',
                                                    ),
                                                    array(
                                                        'value' => 'striped',
                                                        'name' => 'Striped',
                                                    ),
                                                ),
                                            ),
                                            'defaultValue' => 'clean',
                                            'description' => 'Select the features list style from the list. Clean displays the features only without any additional elements. Divided separates the features with lines. Striped displays the features list in a zebra pattern.',
                                        ),
                                        array(
                                            'id' => 'featuresAlign',
                                            'name' => 'Align',
                                            'type' => 'select-inline',
                                            'selectInline' => array(
                                                'options' => array(
                                                    array(
                                                        'value' => 'left',
                                                        'name' => 'Left',
                                                    ),
                                                    array(
                                                        'value' => 'center',
                                                        'name' => 'Center',
                                                    ),
                                                ),
                                            ),
                                            'defaultValue' => 'left',
                                            'description' => 'Select the features text align.',
                                        ),
                                        array(
                                            'id' => 'featuresIconColor',
                                            'name' => 'Icon color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the features icon color.',
                                        ),
                                        array(
                                            'id' => 'featuresTextColor',
                                            'name' => 'Text color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the features text color.',
                                        ),
                                        array(
                                            'id' => 'featuresBackgroundColor',
                                            'name' => 'Background color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the features background color.',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'id' => 'priceGroup',
                                'name' => 'Price',
                                'type' => 'subgroup',
                                'subgroup' => array(
                                    'properties' => array(
                                        array(
                                            'id' => 'price',
                                            'name' => 'Price',
                                            'type' => 'text',
                                            'defaultValue' => '$0',
                                            'allowEmpty' => true,
                                            'description' => 'Set the price.',
                                        ),
                                        array(
                                            'id' => 'priceCaption',
                                            'name' => 'Caption',
                                            'type' => 'text',
                                            'defaultValue' => 'Price caption',
                                            'allowEmpty' => true,
                                            'description' => 'Set the price caption - payment period, special offer, discount price, etc.',
                                        ),
                                        array(
                                            'id' => 'priceTextColor',
                                            'name' => 'Price color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the price text color.',
                                        ),
                                        array(
                                            'id' => 'priceCaptionColor',
                                            'name' => 'Caption color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the price caption color.',
                                        ),
                                        array(
                                            'id' => 'priceBackgroundColor',
                                            'name' => 'Background color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the price area background color.',
                                        ),
                                        array(
                                            'id' => 'priceFontSize',
                                            'name' => 'Font size (px)',
                                            'type' => 'number',
                                            'defaultValue' => 24,
                                            'description' => 'Set the price font size in pixels.',
                                        ),
                                        array(
                                            'id' => 'priceFontWeight',
                                            'name' => 'Font weight',
                                            'type' => 'select-inline',
                                            'selectInline' => array(
                                                'options' => array(
                                                    array(
                                                        'value' => 400,
                                                        'name' => 'Regular',
                                                    ),
                                                    array(
                                                        'value' => 600,
                                                        'name' => 'Bold',
                                                    ),
                                                ),
                                            ),
                                            'defaultValue' => 400,
                                            'description' => 'Choose the price font weight.',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'id' => 'buttonGroup',
                                'name' => 'Button',
                                'type' => 'subgroup',
                                'subgroup' => array(
                                    'properties' => array(
                                        array(
                                            'id' => 'button',
                                            'name' => 'Button label',
                                            'type' => 'text',
                                            'defaultValue' => 'Select',
                                            'allowEmpty' => true,
                                            'description' => 'Set the button label text.',
                                        ),
                                        array(
                                            'id' => 'buttonLink',
                                            'name' => 'Button link',
                                            'type' => 'text',
                                            'defaultValue' => '',
                                            'description' => 'Set the link to redirect your user to after clicking on the button.',
                                        ),
                                        array(
                                            'id' => 'buttonCaption',
                                            'name' => 'Caption',
                                            'type' => 'text',
                                            'defaultValue' => 'Button caption',
                                            'allowEmpty' => true,
                                            'description' => 'Set the button caption. This text under the button can be used as an extra call to action.',
                                        ),
                                        array(
                                            'id' => 'buttonColor',
                                            'name' => 'Button color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the button color.',
                                        ),
                                        array(
                                            'id' => 'buttonBackgroundColor',
                                            'name' => ' Area background color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the button area background color.',
                                        ),
                                        array(
                                            'id' => 'buttonTextColor',
                                            'name' => 'Button label color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the button label color.',
                                        ),
                                        array(
                                            'id' => 'buttonCaptionColor',
                                            'name' => 'Caption color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the button caption color.',
                                        ),
                                        array(
                                            'id' => 'buttonBorderRadius',
                                            'name' => 'Border radius (px)',
                                            'type' => 'number',
                                            'defaultValue' => 5,
                                            'description' => 'Set the button border radius in pixels.',
                                        ),
                                        array(
                                            'id' => 'buttonBorderWidth',
                                            'name' => 'Border width (px)',
                                            'type' => 'number',
                                            'defaultValue' => 0,
                                            'description' => 'Set the button border width in pixels.',
                                        ),
                                        array(
                                            'id' => 'buttonBorderColor',
                                            'name' => 'Border color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the button border color. It\'s applicable when the border with is over 0.',
                                        ),
                                        10 => array(
                                            'id' => 'buttonShadow',
                                            'name' => 'Button shadow',
                                            'type' => 'toggle',
                                            'defaultValue' => true,
                                            'description' => 'Turn on/off the button shadow.',
                                        ),
                                    ),
                                ),
                            ),
                            array(
                                'id' => 'ribbonGroup',
                                'name' => 'Ribbon',
                                'type' => 'subgroup',
                                'subgroup' => array(
                                    'properties' => array(
                                        array(
                                            'id' => 'ribbonText',
                                            'name' => 'Ribbon text',
                                            'type' => 'text',
                                            'defaultValue' => '',
                                            'description' => 'Set the ribbon text. The ribbon is a visual element that will attract more attention to the column where it\'s placed.',
                                        ),
                                        array(
                                            'id' => 'ribbonBackgroundColor',
                                            'name' => 'Background color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the ribbon background color.',
                                        ),
                                        array(
                                            'id' => 'ribbonTextColor',
                                            'name' => 'Text color',
                                            'type' => 'color',
                                            'defaultValue' => '',
                                            'description' => 'Set the ribbon text color.',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'defaultValue' => array(
                        array(
                            'isFeatured' => false,
                            'mainColor' => 'rgb(255, 198, 0)',
                            'additionalColor' => 'rgb(255, 255, 255)',
                            'styleColumnBackgroundColor' => '',
                            'styleColumnBorderRadius' => 16,
                            'styleColumnBorderWidth' => 1,
                            'styleColumnBorderColor' => '',
                            'title' => 'Lite Plan',
                            'titleCaption' => 'Individuals and small teams',
                            'titleCaptionColor' => '',
                            'titleTextColor' => '',
                            'titleBackgroundColor' => '',
                            'titleFontSize' => 24,
                            'titleFontWeight' => 400,
                            'features' => array(
                                array(
                                    'text' => 'Clean and easy to use app',
                                    'icon' => 'check',
                                ),
                                array(
                                    'text' => 'Simple widget generator',
                                    'icon' => 'check',
                                    'hint' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                                ),
                            ),
                            'featuresStyle' => 'clean',
                            'featuresIconColor' => '',
                            'featuresTextColor' => '',
                            'featuresBackgroundColor' => '',
                            'price' => '$9.00',
                            'priceCaption' => 'per month',
                            'priceCaptionColor' => '',
                            'priceTextColor' => '',
                            'priceBackgroundColor' => '',
                            'priceFontSize' => 24,
                            'priceFontWeight' => 400,
                            'button' => 'Select',
                            'buttonLink' => 'https://elfsight.com',
                            'buttonCaption' => 'Vat. is included',
                            'buttonCaptionColor' => '',
                            'buttonColor' => '',
                            'buttonTextColor' => '',
                            'buttonBorderRadius' => 5,
                            'buttonBorderWidth' => 0,
                            'buttonBorderColor' => '',
                            'buttonShadow' => true,
                            'buttonBackgroundColor' => '',
                            'ribbonText' => '',
                            'ribbonBackgroundColor' => 'rgb(255, 255, 255)',
                            'ribbonTextColor' => 'rgb(255, 198, 0)',
                            'picture' => 'https://elfsight.com/assets/pricing-table/pricing-table-column-1.jpg',
                        ),
                        array(
                            'isFeatured' => true,
                            'mainColor' => 'rgb(255, 138, 24)',
                            'additionalColor' => 'rgb(255, 255, 255)',
                            'styleColumnBackgroundColor' => '',
                            'styleColumnBorderRadius' => 16,
                            'styleColumnBorderWidth' => 1,
                            'styleColumnBorderColor' => '',
                            'title' => 'Pro Plan',
                            'titleCaption' => 'Growing businesses',
                            'titleCaptionColor' => '',
                            'titleTextColor' => '',
                            'titleBackgroundColor' => '',
                            'titleFontSize' => 24,
                            'titleFontWeight' => 400,
                            'features' => array(
                                array(
                                    'text' => 'Clean and easy to use app',
                                    'icon' => 'check',
                                ),
                                array(
                                    'text' => 'Simple widget generator',
                                    'icon' => 'check',
                                    'hint' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                                ),
                                array(
                                    'text' => 'Neat dashboard with settings',
                                    'icon' => 'check',
                                ),
                            ),
                            'featuresStyle' => 'clean',
                            'featuresIconColor' => '',
                            'featuresTextColor' => '',
                            'featuresBackgroundColor' => '',
                            'price' => '$19.00',
                            'priceCaption' => 'per month',
                            'priceCaptionColor' => '',
                            'priceTextColor' => '',
                            'priceBackgroundColor' => '',
                            'priceFontSize' => 24,
                            'priceFontWeight' => 400,
                            'button' => 'Select',
                            'buttonLink' => 'https://elfsight.com',
                            'buttonCaption' => 'Vat. is included',
                            'buttonCaptionColor' => '',
                            'buttonColor' => '',
                            'buttonTextColor' => '',
                            'buttonBorderRadius' => 5,
                            'buttonBorderWidth' => 0,
                            'buttonBorderColor' => '',
                            'buttonShadow' => true,
                            'buttonBackgroundColor' => '',
                            'ribbonText' => 'Popular',
                            'ribbonBackgroundColor' => 'rgb(255, 255, 255)',
                            'ribbonTextColor' => 'rgb(255, 138, 24)',
                            'picture' => 'https://elfsight.com/assets/pricing-table/pricing-table-column-2.jpg',
                        ),
                        array(
                            'isFeatured' => false,
                            'mainColor' => 'rgb(255, 95, 75)',
                            'additionalColor' => 'rgb(255, 255, 255)',
                            'styleColumnBackgroundColor' => '',
                            'styleColumnBorderRadius' => 16,
                            'styleColumnBorderWidth' => 1,
                            'styleColumnBorderColor' => '',
                            'title' => 'Enterprise Plan',
                            'titleCaption' => 'Advanced companies',
                            'titleCaptionColor' => '',
                            'titleTextColor' => '',
                            'titleBackgroundColor' => '',
                            'titleFontSize' => 24,
                            'titleFontWeight' => 400,
                            'features' => array(
                                array(
                                    'text' => 'Clean and easy to use app',
                                    'icon' => 'check',
                                ),
                                array(
                                    'text' => 'Simple widget generator',
                                    'icon' => 'check',
                                    'hint' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                                ),
                                array(
                                    'text' => 'Neat dashboard with settings',
                                    'icon' => 'check',
                                ),
                                array(
                                    'text' => 'Helpful live support',
                                    'icon' => 'check',
                                ),
                                array(
                                    'text' => 'Transparent price structure',
                                    'icon' => 'check',
                                ),
                            ),
                            'featuresStyle' => 'clean',
                            'featuresIconColor' => '',
                            'featuresTextColor' => '',
                            'featuresBackgroundColor' => '',
                            'price' => '$29.00',
                            'priceCaption' => 'per month',
                            'priceCaptionColor' => '',
                            'priceTextColor' => '',
                            'priceBackgroundColor' => '',
                            'priceFontSize' => 24,
                            'priceFontWeight' => 400,
                            'button' => 'Select',
                            'buttonLink' => 'https://elfsight.com',
                            'buttonCaption' => 'Vat. is included',
                            'buttonCaptionColor' => '',
                            'buttonColor' => '',
                            'buttonBackgroundColor' => '',
                            'buttonTextColor' => '',
                            'buttonBorderRadius' => 5,
                            'buttonBorderWidth' => 0,
                            'buttonBorderColor' => '',
                            'buttonShadow' => true,
                            'buttonContainerBackgroundColor' => '',
                            'ribbonText' => '',
                            'ribbonBackgroundColor' => 'rgb(62, 203, 0)',
                            'ribbonTextColor' => 'rgb(255, 255, 255)',
                            'picture' => 'https://elfsight.com/assets/pricing-table/pricing-table-column-3.jpg',
                        ),
                    ),
                ),
            ),
        ),
        'editor_preferences' => array(
            'previewUpdateTimeout' => 0
        ),
        'script_url' => plugins_url('assets/elfsight-pricing-table.js', __FILE__),

        'plugin_name' => 'Elfsight Pricing Table',
        'plugin_file' => __FILE__,
        'plugin_slug' => plugin_basename(__FILE__),

        'vc_icon' => plugins_url('assets/img/vc-icon.png', __FILE__),

        'menu_icon' => plugins_url('assets/img/menu-icon.png', __FILE__),
        'update_url' => 'https://a.elfsight.com/updates/',

        'preview_url' => plugins_url('preview/', __FILE__),
        'observer_url' => plugins_url('preview/pricing-table-observer.js', __FILE__),

        'product_url' => 'https://codecanyon.net/user/elfsight/portfolio?ref=Elfsight',
        'support_url' => 'https://elfsight.ticksy.com/submit/#100011050'
    )
);

?>