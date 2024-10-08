import { ArrowBigUp, Folder, Link, PlusCircle, Tag } from "lucide-react";
import React, { useEffect, useState } from "react";
import InfiniteScroll from "react-infinite-scroll-component";
import LinkCard from "../components/LinkCard";
import { Button } from "../components/ui/button";
import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
} from "../components/ui/card";
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from "../components/ui/tabs";
import { getCollections } from "../services/collection";
import { getLinks } from "../services/link";
import { getTags } from "../services/tag";
import { Collection, Link as TLink, Tag as TTag } from "../services/type";
interface Props {}

const Home: React.FC<Props> = () => {
    const [countLink, setCountLink] = useState<number>(0);
    const [countTag, setCountTag] = useState<number>(0);
    const [countCollection, setCountCollection] = useState<number>(0);

    const [dataLink, setDataLink] = useState<TLink[]>([]);
    const [dataCollection, setDataCollection] = useState<Collection[]>([]);
    const [dataTag, setDataTag] = useState<TTag[]>([]);
    const [page, setPage] = useState<number>(1);
    const [hasMore, setHasMore] = useState<boolean>(true);
    const [tabValue, setTabValue] = useState<string>("link");
    const scrollToTop = () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth", // Cuộn mượt
        });
    };
    useEffect(() => {
        fetchData();
    }, []);
    const fetchData = async () => {
        try {
            const links = await getLinks(page);
            const tags = await getTags(1);
            const collections = await getCollections(1);

            setCountLink(links.total);
            setCountTag(tags.total);
            setCountCollection(collections.total);

            setDataCollection(collections.data);
            setDataLink(links.data);
            setDataTag(tags.data);
            setPage(page + 1);
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    };
    const fetchMoreData = async () => {
        try {
            if (dataLink.length >= countLink) {
                setHasMore(false);
                return;
            }
            const links = await getLinks(page);

            setCountLink(links.total);
            setDataLink((prevState) => {
                return [...prevState, ...links.data];
            });
            setPage(page + 1);
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    };
    return (
        <>
            <button className="scroll-to-top" onClick={scrollToTop}>
                <ArrowBigUp />
            </button>
            <div className="relative w-full space-y-4 p-8 pt-6">
                <div className="flex items-center justify-between space-y-2">
                    <h2 className="text-3xl font-bold tracking-tight">
                        Dashboard
                    </h2>
                </div>
                <Tabs
                    onValueChange={(value) => {
                        setTabValue(value);
                    }}
                    defaultValue="link"
                    className="space-y-4"
                >
                    <div className="flex items-center">
                        <TabsList>
                            <TabsTrigger value="link">Link</TabsTrigger>
                            <TabsTrigger value="collection">
                                Collection
                            </TabsTrigger>
                            <TabsTrigger value="tag">Tag</TabsTrigger>
                        </TabsList>
                        <div className="ml-auto flex items-center gap-2">
                            <Button size="sm" className="h-7 gap-1">
                                <PlusCircle className="h-3.5 w-3.5" />
                                <span className="sr-only sm:not-sr-only sm:whitespace-nowrap">
                                    Add {tabValue}
                                </span>
                            </Button>
                        </div>
                    </div>
                    <TabsContent value="link" className="space-y-4">
                        <div className="grid gap-3 md:grid-cols-1 lg:grid-cols-3">
                            <Card>
                                <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                    <CardTitle className="text-sm font-medium">
                                        Link
                                    </CardTitle>
                                    <Link className="h-4 w-4 text-muted-foreground" />
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold">
                                        {countLink}
                                    </div>
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                    <CardTitle className="text-sm font-medium">
                                        Collection
                                    </CardTitle>
                                    <Folder className="h-4 w-4 text-muted-foreground" />
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold">
                                        {countCollection}
                                    </div>
                                </CardContent>
                            </Card>
                            <Card>
                                <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                    <CardTitle className="text-sm font-medium">
                                        Tag
                                    </CardTitle>
                                    <Tag className="h-4 w-4 text-muted-foreground" />
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold">
                                        {countTag}
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                        <div className="flex items-center justify-between space-y-2">
                            <h3 className="text-2xl font-bold tracking-tight">
                                Link
                            </h3>
                        </div>
                        <InfiniteScroll
                            dataLength={dataLink.length}
                            next={fetchMoreData}
                            loader={<h4>Loading...</h4>}
                            hasMore={hasMore}
                            endMessage={
                                <p style={{ textAlign: "center" }}>
                                    <b>Yay! You have seen it all</b>
                                </p>
                            }
                        >
                            <div className="grid min-[1901px]:grid-cols-5 min-[1501px]:grid-cols-4 min-[881px]:grid-cols-3 min-[551px]:grid-cols-2 grid-cols-1 gap-5 pb-5">
                                {dataLink.map((link, index) => (
                                    <LinkCard
                                        key={`link-${index}`}
                                        link={link}
                                    />
                                ))}
                            </div>
                        </InfiniteScroll>
                    </TabsContent>
                    <TabsContent value="collection" className="space-y-4">
                        <div className="grid gap-3 md:grid-cols-1 lg:grid-cols-3">
                            {dataCollection.map((collection, index) => (
                                <Card key={`collection-${index}`}>
                                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                        <CardTitle className="text-sm font-medium truncate w-full pr-9">
                                            {collection.name}
                                        </CardTitle>
                                    </CardHeader>
                                    <CardContent>
                                        <div
                                            className="text-2xl truncate w-full pr-9"
                                            dangerouslySetInnerHTML={{
                                                __html: collection.description,
                                            }}
                                        ></div>
                                    </CardContent>
                                </Card>
                            ))}
                        </div>
                    </TabsContent>
                    <TabsContent value="tag" className="space-y-4">
                        <div className="grid gap-3 md:grid-cols-1 lg:grid-cols-3">
                            {dataTag.map((tag, index) => (
                                <Card key={`tag-${index}`}>
                                    <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                        <CardTitle className="text-2xl truncate w-full pr-9">
                                            {tag.name}
                                        </CardTitle>
                                    </CardHeader>
                                    <CardContent>
                                        <div className="text-2xl truncate w-full pr-9">
                                            {tag.created_at}
                                        </div>
                                    </CardContent>
                                </Card>
                            ))}
                        </div>
                    </TabsContent>
                </Tabs>
            </div>
        </>
    );
};

export default Home;
