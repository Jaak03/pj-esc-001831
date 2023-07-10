import Dropdown from "@/Components/Dropdown";
import PrimaryButton from "@/Components/PrimaryButton";

export default function OrderDetails({ order, auth, ...props }) {
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
                <PrimaryButton className="flex max-h-12 mt-6 text-center justify-center">Check Out</PrimaryButton>
            </form>
        </div>
    );
}
