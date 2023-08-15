import Dropdown from "@/Components/Dropdown";
import PrimaryButton from "@/Components/PrimaryButton";
import {useState} from "react";

const checkout = (e, order, auth, setCheckoutLink, link) => {
    e.preventDefault();
    setCheckoutLink(link);
    console.log({
        message: "checkout",
        order,
        auth,
    });
}

export default function OrderDetails({ order, auth, ...props }) {

    const [checkoutLink, setCheckoutLink] = useState(null);

    return (
        <div {...props} className="flex flex-col gap-6 mx-6">
            <div>
                <h1 className="text-3xl lg:text-left text-center">{order.name}</h1>
                {order.description.split("\n\n", ).map((paragraph) => (
                    <>
                        <br/>
                        <p className="text-gray-500 max-w-xl lg:text-left text-center">{paragraph}</p>
                    </>
                ))}
            </div>
            <form className="flex flex-col">
                <Dropdown classname="flex text-red-600"/>
                <div className="flex flex-col justify-between gap-4 mb-4">
                    {
                        order.prices
                            .map(({ price = 'free', title = 'item'}) => (
                                <div className="flex flex-row justify-between">
                                    <p className="text-gray-500">{title}</p>
                                    <p className="text-gray-500">{price}</p>
                                </div>
                            ))
                    }
                    <div className="flex flex-row justify-between border-t pt-2">
                        <p className="text-gray-500 font-semibold">Total</p>
                        <p className="text-gray-500">{order.total}</p>
                    </div>
                </div>

                {/*
                    When the user clicks on the checkout button, we then generate the transaction, checkout link,
                     and redirect the user to the checkout page.
                */}
                {checkoutLink && (
                    <a href={checkoutLink} target="_blank" rel="noreferrer"> Link </a>
                )}

                <PrimaryButton
                    className="flex max-h-12 mt-6 text-center justify-center"
                    onClick={(e) => {
                        const link = 'https://pay-sit.tradesafe.dev/checkout/embed/eyJpdiI6ImpaNDFYRkhEa0Y1VkhaNzZOUmIwZ1E9PSIsInZhbHVlIjoiYzJMbkNrdkwwZ3dreTRiYjFwYUJBL043MWt0UVdSWjlFZGdXaXJFSmFWaC8rSVVkd2xVeXJkR3Z3UlRlUUIweGxCeVdNbWxJTDdsWW5xcnhKQlhaTU82Wk8yS2FqL1VBL0drTjBjRzFOd0M3N3hEelErZEVYV3NDbXc0Q0hxWFRQQlNRR1JDVHFQMUlsNlVndFE2N0FvQzJ0TkNlR0pSZzJSUm1sNklKRFlITk0zcDhCM3Bud2pxZVhuNWVocE1WS2Y3Z2p0aWQzTkVqZ3NjdGpaN2RtRnQ5VWhZS2VIL0ovZ2NsU3RlOFZOcz0iLCJtYWMiOiI2ZDI4ZTc2MDQ2MThiYjc1MjZkYjU1OWI0Mzg0NjI1YjY4NWU1ZjkyNjk1NGI0OGM5YzdkYzY5ZjE1NTA0MDMyIiwidGFnIjoiIn0='
                        checkout(e, order, auth, setCheckoutLink, link)
                    }}
                >
                    Check Out
                </PrimaryButton>
            </form>
        </div>
    );
}
