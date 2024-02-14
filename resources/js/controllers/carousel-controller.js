export default class extends window.Controller
{
    connect() {
        this.carousel = new window.Bootstrap.Carousel(this.element.querySelector('.oi-carousel'), {
            // @see https://getbootstrap.com/docs/5.0/components/carousel/#options
        })
    }
}
