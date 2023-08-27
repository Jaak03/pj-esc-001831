import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import ImageCarousel from "@/Components/ImageCarousel";
import OrderDetails from "@/Pages/Product/Partials/Details";

export default function Order({ auth, payment = null, product = null, ...props }) {
    if (payment !== null) {
        console.log({
            payment,
        });
    }

    if (product !== null) {
        console.log({
            product,
        });
    }

    const prices = [
        {
            title: "Shipping",
            price: 0,
        },
        {
            title: "Cost",
            price: 100,
        }
    ];

    return (
        <AuthenticatedLayout
            user={auth.user}
        >
            <div className="flex lg:flex-row flex-col items-center">
                <div className="basis-1/2 lg:mx-6 mx-0 lg:mg-0">
                    <ImageCarousel className="w-full" images={[
                        "/storage/images/1.jpg",
                        // "storage/images/2.jpg",
                        "/storage/images/3.jpg",
                    ]}/>
                </div>
                <OrderDetails className="flex basis-1/2 lg:pr-6 px-6" order={{
                        uuid: "1234567890",
                        name: "Test Order",
                        description: "Tristique curabitur sollicitudin enim nunc, tempor vestibulum bibendum a nostra purus. Nibh montes ridiculus massa. Eros elementum sodales facilisis nunc erat elit pharetra. Tincidunt nulla nibh nascetur mi. Pretium vestibulum Tellus neque. Commodo. Suspendisse egestas fringilla conubia faucibus nullam dignissim viverra ullamcorper aliquet.\n" +
                            "\n" +
                            "Eleifend sem proin facilisi tellus pede donec eros porttitor ridiculus eu turpis vel erat leo lacus. Elit. Fermentum. Natoque. Tempus sagittis malesuada cubilia suscipit montes. Scelerisque sociis fames ultricies lacinia tellus amet dictumst nam mus metus.\n" +
                            "\n" +
                            "Commodo Justo porta lectus, pharetra auctor est senectus tristique lobortis condimentum id. Neque. Penatibus, arcu natoque aliquet. Etiam senectus nulla justo.",
                        prices: prices.map(({ title, price }) => ({title, price: `${price ? 'R ' + price : 'free'}` })),
                        total: 'R ' + prices.reduce((total, { price }) => total + price, 0),
                    }} auth={auth}/>
            </div>
        </AuthenticatedLayout>
    );
}
